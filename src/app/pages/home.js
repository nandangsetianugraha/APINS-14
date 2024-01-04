$(function() {
  const isRtl = $("html").attr("dir") === "rtl"

  $("#widget-carousel").slick({
    rtl: isRtl, // Carousel direction
    asNavFor: "#widget-carousel-nav", // Make this carousel as navigation for #widget-carousel-nav carousel
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false
  })

  $("#widget-carousel-nav").slick({
    rtl: isRtl, // Carousel direction
    asNavFor: "#widget-carousel", // Make this carousel as navigation for #widget-carousel carousel
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    centerMode: true
  })

  // Set default theme variation variables
  const isDarkDefault = localStorage.getItem("theme-variant") == "dark"
  const themeVariantDefault = isDarkDefault ? "dark" : "light"

  // Currency formatter for supporting chart widgets
  const currency = new Intl.NumberFormat("en-US", {
    style: "currency",
    currency: "USD",
    minimumFractionDigits: 0
  })

  // Collection of hex colors for chart widgets
  const colors = {
    blue: "#2196f3",
    green: "#4caf50",
    red: "#f44336",
    white: "#fff",
    black: "#424242"
  }

  // Chart widgets theme options
  const themeOptions = {
    light: {
      theme: {
        mode: "light",
        palette: "palette1"
      }
    },
    dark: {
      theme: {
        mode: "dark",
        palette: "palette1"
      }
    }
  }

  const widgetChart1 = new ApexCharts(document.querySelector("#widget-chart-1"), {
    ...themeOptions[themeVariantDefault], // Add theme option to chart
    series: [
      {
        name: "Revenue",
        data: [3100, 4000, 2800, 5100, 4200, 10900, 5600, 8600, 7000]
      }
    ],
    chart: {
      type: "area",
      height: 300,
      background: "transparent",
      sparkline: {
        enabled: true
      }
    },
    fill: {
      type: "solid"
    },
    markers: {
      strokeColors: isDarkDefault ? colors.black : colors.white
    },
    stroke: {
      show: false
    },
    tooltip: {
      marker: {
        show: false
      },
      y: {
        formatter: val => currency.format(val) // Format chart tooltip value
      }
    },
    xaxis: {
      categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep"],
      crosshairs: {
        show: false
      }
    },
    responsive: [
      {
        breakpoint: 576,
        options: {
          chart: {
            height: 200
          }
        }
      }
    ]
  })

  const widgetChart6 = new ApexCharts(document.querySelector("#widget-chart-6"), {
    ...themeOptions[themeVariantDefault], // Add theme option to chart
    series: [
      {
        name: "Unique",
        data: [6400, 4000, 7600, 6200, 9800, 6400, 8600, 7000]
      }
    ],
    chart: {
      type: "area",
      background: "transparent",
      height: 300,
      sparkline: {
        enabled: true
      }
    },
    markers: {
      strokeColors: isDarkDefault ? colors.black : colors.white
    },
    fill: {
      type: "gradient",
      gradient: {
        shade: themeVariantDefault,
        type: "vertical",
        opacityFrom: 1,
        opacityTo: 0,
        stops: [0, 100]
      }
    },
    tooltip: {
      marker: {
        show: false
      },
      y: {
        formatter: val => `${val} Visited` // Format chart tooltip value
      }
    },
    xaxis: {
      categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug"],
      crosshairs: {
        show: false
      }
    }
  })

  const widgetChart7 = $(".widget-chart-7").map(function() {
    // Get chart properties from dom
    let color = $(this).data("chart-color")
    let label = $(this).data("chart-label")
    let series = $(this)
      .data("chart-series")
      .split(",")
      .map(data => Number(data))
    let enabledCurrency = $(this).data("chart-currency")

    return new ApexCharts(this, {
      ...themeOptions[themeVariantDefault], // Add theme option to chart
      series: [
        {
          name: label,
          data: series
        }
      ],
      chart: {
        type: "area",
        height: 200,
        background: "transparent",
        sparkline: {
          enabled: true
        }
      },
      fill: {
        type: "solid",
        colors: [color],
        opacity: 0.1
      },
      stroke: {
        show: true,
        colors: [color]
      },
      markers: {
        colors: [isDarkDefault ? colors.black : colors.white],
        strokeWidth: 4,
        strokeColors: color
      },
      tooltip: {
        marker: {
          show: false
        },
        y: {
          formatter: val => (Boolean(enabledCurrency) ? currency.format(val) : val) // Format chart tooltip value
        }
      },
      xaxis: {
        categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
        crosshairs: {
          show: false
        }
      }
    })
  })

  widgetChart1.render()
  widgetChart6.render()
  widgetChart7.each(function() {
    this.render()
  })

  // Theme toggle listener
  $("#theme-toggle").on("click", function() {
    // Get theme data
    const isDark = $("html").attr("data-theme") == 'dark'
    const themeVariant = isDark ? "dark" : "light"

    // Update all widget colors
    widgetChart1.updateOptions({
      ...themeOptions[themeVariant],
      markers: { strokeColors: isDark ? colors.black : colors.white }
    })
    widgetChart6.updateOptions({
      ...themeOptions[themeVariant],
      markers: { strokeColors: isDark ? colors.black : colors.white },
      fill: {
        gradient: { shade: themeVariant }
      }
    })
    widgetChart7.each(function() {
      this.updateOptions({
        ...themeOptions[themeVariant],
        markers: { colors: [isDark ? colors.black : colors.white] }
      })
    })
  })
})