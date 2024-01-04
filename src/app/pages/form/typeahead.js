$(function() {
  // Suggestion dummy data
  const data = [
    "Alabama",
    "Alaska",
    "Arizona",
    "Arkansas",
    "California",
    "Colorado",
    "Connecticut",
    "Delaware",
    "Florida",
    "Georgia",
    "Hawaii",
    "Idaho",
    "Illinois",
    "Indiana",
    "Iowa",
    "Kansas",
    "Kentucky",
    "Louisiana",
    "Maine",
    "Maryland",
    "Massachusetts",
    "Michigan",
    "Minnesota",
    "Mississippi",
    "Missouri",
    "Montana",
    "Nebraska",
    "Nevada",
    "New Hampshire",
    "New Jersey",
    "New Mexico",
    "New York",
    "North Carolina",
    "North Dakota",
    "Ohio",
    "Oklahoma",
    "Oregon",
    "Pennsylvania",
    "Rhode Island",
    "South Carolina",
    "South Dakota",
    "Tennessee",
    "Texas",
    "Utah",
    "Vermont",
    "Virginia",
    "Washington",
    "West Virginia",
    "Wisconsin",
    "Wyoming"
  ]

  // Keyword matcher function
  function matcher(dataset) {
    return function findMatches(query, callback) {
      let matches = []
      let regex = new RegExp(query, "i")

      dataset.forEach(data => {
        if (regex.test(data)) {
          matches.push(data)
        }
      })

      callback(matches)
    }
  }

  // Initialize typeahead
  $("#typeahead-1").typeahead(
    {
      hint: true,
      highlight: true,
      minLength: 1
    },
    {
      name: "states",
      source: matcher(data)
    }
  )

  // Initialize suggestion engine
  const states = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.whitespace,
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    local: data // Insert data from internal array
  })

  // Initialize typeahead
  $("#typeahead-2").typeahead(
    {
      hint: true,
      highlight: true,
      minLength: 1
    },
    {
      name: "states",
      source: states
    }
  )

  // Initialize suggestion engine
  const bestPictures = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace("value"),
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    prefetch: "https://twitter.github.io/typeahead.js/data/films/post_1960.json" // Insert data from API
  })

  // Initialize typeahead
  $("#typeahead-3").typeahead(null, {
    name: "best-pictures",
    display: "value",
    source: bestPictures
  })

  // Initialize typeahead
  $("#typeahead-4").typeahead(null, {
    name: "best-pictures",
    display: "value",
    source: bestPictures,

    // Custom templates
    templates: {
      empty: `<div class="tt-empty-message">Not found</div>`,
      suggestion: Handlebars.compile(`
        <div class="tt-menu-item">
          <div class="tt-menu-content">
            <h4 class="tt-menu-title">{{value}}</h4>
            <span class="tt-menu-subtitle">{{year}}</span>
          </div>
        </div>
      `)
    }
  })

  // Initialize suggestion engine
  const nflTeams = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace("team"),
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    identify: obj => obj.team, // Set custom object node for identification key
    prefetch: "https://twitter.github.io/typeahead.js/data/nfl.json" // Insert data from API
  })

  // Default suggestion function from nflTeams data
  function nflTeamsWithDefaults(query, sync) {
    if (query === "") {
      sync(nflTeams.get("Detroit Lions", "Green Bay Packers", "Chicago Bears"))
    } else {
      nflTeams.search(query, sync)
    }
  }

  // Initialize typeahead
  $("#typeahead-5").typeahead(
    {
      minLength: 0,
      highlight: true
    },
    {
      name: "nfl-teams",
      display: "team",
      source: nflTeamsWithDefaults
    }
  )

  // Initialize suggestion engine
  const nbaTeams = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace("team"),
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    prefetch: "https://twitter.github.io/typeahead.js/data/nba.json" // Insert data from API
  })

  // Initialize suggestion engine
  const nhlTeams = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace("team"),
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    prefetch: "https://twitter.github.io/typeahead.js/data/nhl.json" // Insert data from API
  })

  // Initialize typeahead
  $("#typeahead-6").typeahead(
    {
      highlight: true
    },
    {
      name: "nba-teams",
      display: "team",
      source: nbaTeams,

      // Custom templates
      templates: {
        header: '<h3 class="tt-header">NBA Teams</h3>'
      }
    },
    {
      name: "nhl-teams",
      display: "team",
      source: nhlTeams,

      // Custom templates
      templates: {
        header: '<h3 class="tt-header">NHL Teams</h3>'
      }
    }
  )
})
