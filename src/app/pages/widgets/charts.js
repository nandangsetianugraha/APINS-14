$(function() {
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

  const widgetChart2 = new ApexCharts(document.querySelector("#widget-chart-2"), {
    ...themeOptions[themeVariantDefault], // Add theme option to chart
    series: [
      {
        name: "Revenue",
        data: [4000, 9600, 4600, 13600, 6800, 14600, 11000]
      },
      {
        name: "Profit",
        data: [3100, 8000, 2800, 5100, 2000, 10900, 10000]
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
      opacity: 0.8,
      type: "solid"
    },
    markers: {
      strokeColors: isDarkDefault ? colors.black : colors.white
    },
    stroke: {
      show: false
    },
    tooltip: {
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

  const widgetChart3 = $(".widget-chart-3").map(function() {
    // Get chart properties from dom
    let color = $(this).data("chart-color")
    let label = $(this).data("chart-label")
    let series = $(this)
      .data("chart-series")
      .split(",")
      .map(data => Number(data))

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
        height: 50,
        background: "transparent",
        sparkline: {
          enabled: true
        }
      },
      fill: {
        opacity: 0,
        type: "solid"
      },
      stroke: {
        show: true,
        colors: [color],
        lineCap: "round"
      },
      markers: {
        colors: [isDarkDefault ? colors.black : colors.white],
        strokeWidth: 4,
        strokeColors: color
      },
      tooltip: {
        followCursor: true,
        marker: {
          show: false
        },
        x: {
          show: false
        },
        y: {
          formatter: val => `${val} Tests` // Format chart tooltip value
        },
        fixed: {
          enabled: true,
          position: "topLeft",
          offsetY: -30
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

  const widgetChart4 = new ApexCharts(document.querySelector("#widget-chart-4"), {
    ...themeOptions[themeVariantDefault], // Add theme option to chart
    series: [2000, 7000, 1000],
    labels: ["Margin", "Profit", "Lost"],
    chart: {
      width: 300,
      type: "donut",
      background: "transparent",
    },
    stroke: {
      colors: [isDarkDefault ? colors.black : colors.white]
    },
    colors: [colors.blue, colors.green, colors.red],
    tooltip: {
      fillSeriesColor: false,
      y: {
        formatter: val => currency.format(val) // Format chart tooltip value
      }
    },
    legend: {
      show: false
    },
    dataLabels: {
      enabled: false
    }
  })

  const widgetChart5 = new ApexCharts(document.querySelector("#widget-chart-5"), {
    ...themeOptions[themeVariantDefault], // Add theme option to chart
    series: [
      {
        name: "Sales",
        data: [640, 400, 760, 620, 980, 640]
      }
    ],
    chart: {
      type: "area",
      background: "transparent",
      height: 300,
      toolbar: {
        show: false
      }
    },
    dataLabels: {
      enabled: false
    },
    fill: {
      opacity: 0,
      type: "solid",
    },
    stroke: {
      show: true,
      colors: [colors.blue],
      lineCap: "round"
    },
    markers: {
      colors: [isDarkDefault ? colors.black : colors.white],
      strokeWidth: 4,
      strokeColors: colors.blue
    },
    tooltip: {
      marker: {
        show: false
      },
      y: {
        formatter: val => `${val} Products` // Format chart tooltip value
      }
    },
    xaxis: {
      categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"]
    }
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

  const widgetChart8 = new ApexCharts(document.querySelector("#widget-chart-8"), {
    ...themeOptions[themeVariantDefault], // Add theme option to chart
    series: [
      {
        name: "Profit",
        data: [4400, 5500, 5700, 5600, 6100, 5800, 6300, 6000]
      },
      {
        name: "Revenue",
        data: [7600, 8500, 10100, 9800, 8700, 10500, 9100, 11400]
      },
      {
        name: "Free Cash",
        data: [3500, 4100, 3600, 2600, 4500, 4800, 5200, 5300]
      }
    ],
    chart: {
      type: "bar",
      height: 200,
      background: "transparent",
      sparkline: {
        enabled: true
      }
    },
    fill: {
      opacity: 1
    },
    stroke: {
      show: true,
      width: 2,
      colors: ["transparent"]
    },
    plotOptions: {
      bar: {
        horizontal: false
      }
    },
    dataLabels: {
      enabled: false
    },
    xaxis: {
      categories: ["Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep"]
    },
    tooltip: {
      y: {
        formatter: val => currency.format(val) // Format chart tooltip value
      }
    }
  })

  const widgetChart9 = $(".widget-chart-9").map(function() {
    // Get chart properties from dom
    let color = $(this).data("chart-color")
    let label = $(this).data("chart-label")
    let series = $(this)
      .data("chart-series")
      .split(",")
      .map(data => Number(data))

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
        height: 150,
        background: "transparent",
        sparkline: {
          enabled: true
        }
      },
      fill: {
        type: "solid",
        opacity: 0
      },
      markers: {
        strokeColors: isDarkDefault ? colors.black : colors.white
      },
      stroke: {
        show: true,
        colors: [color],
        lineCap: "round"
      },
      tooltip: {
        marker: {
          show: false
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

  // Render all chart widgets
  widgetChart1.render()
  widgetChart2.render()
  widgetChart3.each(function() {
    this.render()
  })
  widgetChart4.render()
  widgetChart5.render()
  widgetChart6.render()
  widgetChart7.each(function() {
    this.render()
  })
  widgetChart8.render()
  widgetChart9.each(function() {
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
    widgetChart2.updateOptions({
      ...themeOptions[themeVariant],
      markers: { strokeColors: isDark ? colors.black : colors.white }
    })
    widgetChart3.each(function() {
      this.updateOptions({
        ...themeOptions[themeVariant],
        markers: { colors: [isDark ? colors.black : colors.white] }
      })
    })
    widgetChart4.updateOptions({
      ...themeOptions[themeVariant],
      stroke: { colors: [isDark ? colors.black : colors.white] }
    })
    widgetChart5.updateOptions({
      ...themeOptions[themeVariant],
      markers: { colors: [isDark ? colors.black : colors.white] }
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
    widgetChart8.updateOptions(themeOptions[themeVariant])
    widgetChart9.each(function() {
      this.updateOptions({
        ...themeOptions[themeVariant],
        markers: { strokeColors: isDark ? colors.black : colors.white }
      })
    })
  })
})
