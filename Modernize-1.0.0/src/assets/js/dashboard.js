$(async function () {


  // ha una peticion ajax para obtener los datos de compras y ventas a C:\xampp_def\htdocs\fruitables-1.0.0\apis.php que esta en la carpeta padre C:\xampp_def\htdocs\fruitables-1.0.0\vista_de_jefe\Modernize-1.0.0\src\assets\js\dashboard.js
  function getSales() {
    return new Promise((resolve, reject) => {
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "/fruitables-1.0.0/Modernize-1.0.0/src/assets/js/apis.php?ventas_por_mes", true);
      xhr.onload = function () {
        if (this.status >= 200 && this.status < 300) {
          console.log('Success:', xhr.response);
          var data = JSON.parse(xhr.response);
          var sales = data.sales;
          var salesData = Object.values(sales).map(Number);
          resolve(salesData);
        } else {
          console.error('Error:', {status: this.status, statusText: xhr.statusText});
          resolve([]); // Resolves to an empty array in case of error
        }
      };
      xhr.onerror = function () {
        console.error('Error:', {status: this.status, statusText: xhr.statusText});
        resolve([]); // Resolves to an empty array in case of error
      };
      xhr.send();
    });
  }

  var salesData = await getSales();
  // =====================================
  // Profit
  // =====================================
  var chart = {
    series: [
      {name: "ganancias al mes", data: salesData},
    ],

    chart: {
      type: "bar",
      height: 345,
      offsetX: -15,
      toolbar: {show: true},
      foreColor: "#adb0bb",
      fontFamily: 'inherit',
      sparkline: {enabled: false},
    },


    colors: ["#5D87FF", "#49BEFF"],


    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: "35%",
        borderRadius: [6],
        borderRadiusApplication: 'end',
        borderRadiusWhenStacked: 'all'
      },
    },
    markers: {size: 0},

    dataLabels: {
      enabled: true,
    },


    legend: {
      show: true,
    },


    grid: {
      borderColor: "rgba(0,0,0,0.1)",
      strokeDashArray: 3,
      xaxis: {
        lines: {
          show: false,
        },
      },
    },

    xaxis: {
      type: "category",
      categories: ["ene", "feb", "mar", "abr", "may", "jun", "jul", "ago", "sep", "oct", "nov", "dic"],
      labels: {
        style: {cssClass: "grey--text lighten-2--text fill-color"},
      },
    },


    yaxis: {
      show: true,
      min: 0,
      max: Math.ceil(salesData.reduce((a, b) => Math.max(a, b)) / 1000) * 1000,
      tickAmount: 10,
      labels: {
        style: {
          cssClass: "grey--text lighten-2--text fill-color",
        },
      },
    },
    stroke: {
      show: true,
      width: 3,
      lineCap: "butt",
      colors: ["transparent"],
    },
    tooltip: { theme: "light" },

    responsive: [
      {
        breakpoint: 600,
        options: {
          plotOptions: {
            bar: {
              borderRadius: 3,
            }
          },
        }
      }
    ]


  };

  var chart = new ApexCharts(document.querySelector("#chart"), chart);
  chart.render();


  function obtener_ultimos_3_anos() {
  const currentYear = new Date().getFullYear();
  return [currentYear - 2, currentYear - 1, currentYear];
}
function obtener_ventas_de_los_ultimos_3_anos(){
    return promise = new Promise((resolve, reject) => {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/fruitables-1.0.0/Modernize-1.0.0/src/assets/js/apis.php?ventas_por_anio", true);
        xhr.onload = function () {
            if (this.status >= 200 && this.status < 300) {
                console.log('Success:', xhr.response);
                var data = JSON.parse(xhr.response);
                var sales = data.sales;
                var salesData = sales;
                resolve(salesData);
            } else {
                console.error('Error:', {status: this.status, statusText: xhr.statusText});
                resolve([]); // Resolves to an empty array in case of error
            }
        };
        xhr.onerror = function () {
            console.error('Error:', {status: this.status, statusText: xhr.statusText});
            resolve([]); // Resolves to an empty array in case of error
        };
        xhr.send();
    })
  }
  // =====================================
  // Breakup
  // =====================================
  var salesData = await obtener_ventas_de_los_ultimos_3_anos();
  console.log(salesData);
  var breakup = {
    color: "#adb5bd",
    labels: Object.keys(salesData), // Get the keys of the salesData object
    series: Object.values(salesData).map(Number), // Get the values of the salesData object and convert them to numbers
    chart: {
      width: 180,
      type: "donut",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
    },
    plotOptions: {
      pie: {
        startAngle: 0,
        endAngle: 360,
        donut: {
          size: '75%',
        },
      },
    },
    stroke: {
      show: false,
    },

    dataLabels: {
      enabled: false,
    },

    legend: {
      show: false,
    },
    colors: ["#5D87FF", "#ecf2ff", "#F9F9FD"],

    responsive: [
      {
        breakpoint: 991,
        options: {
          chart: {
            width: 150,
          },
        },
      },
    ],
    tooltip: {
      theme: "dark",
      fillSeriesColor: false,
    },
  };

  var chart = new ApexCharts(document.querySelector("#breakup"), breakup);
  chart.render();



  function obtener_usuraios_por_mes(){
    return promise = new Promise((resolve, reject) => {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/fruitables-1.0.0/Modernize-1.0.0/src/assets/js/apis.php?usuarios_por_mes", true);
        xhr.onload = function () {
            if (this.status >= 200 && this.status < 300) {
                console.log('Success:', xhr.response);
                var data = JSON.parse(xhr.response);
                var users = data.users;
                var usersData = Object.values(users).map(Number);
                console.log(usersData);
                resolve(usersData);
            } else {
                console.error('Error:', {status: this.status, statusText: xhr.statusText});
                resolve([]); // Resolves to an empty array in case of error
            }
        };
        xhr.onerror = function () {
            console.error('Error:', {status: this.status, statusText: xhr.statusText});
            resolve([]); // Resolves to an empty array in case of error
        };
        xhr.send();
    })
  }
  var usersData = await obtener_usuraios_por_mes();
  // =====================================
  // Earning
  // =====================================
  var earning = {
    chart: {
      id: "sparkline3",
      type: "area",
      height: 60,
      sparkline: {
        enabled: true,
      },
      group: "sparklines",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
    },
    series: [
      {
        name: "Usuarios",
        color: "#49BEFF",
        data:usersData,
      },
    ],
    stroke: {
      curve: "smooth",
      width: 2,
    },
    fill: {
      colors: ["#f3feff"],
      type: "solid",
      opacity: 0.05,
    },

    markers: {
      size: 0,
    },
    tooltip: {
      theme: "dark",
      fixed: {
        enabled: true,
        position: "right",
      },
      x: {
        show: true,
      },
    },
  };
  new ApexCharts(document.querySelector("#earning"), earning).render();
})