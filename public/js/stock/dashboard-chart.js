
makeChart();
function makeChart() {
        var ctx = document.getElementById('stockSales');
        const months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Okt','Nov','Des'];
        var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: 'PENJUALAN BARANG',
                data: [12, 19, 3, 5, 2, 3,12, 19, 3, 5, 2, 3],
                backgroundColor: 
                
                    'rgba(64, 224, 208)',
                borderColor: 'white',
                borderWidth: 1
            }]
        },

        options: {
            legend:{
                labels:{
                    defaultFontColor: "#666",
                },
            },
            defaultFontSize: 14,
            maintainAspectRatio:false,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    Chart.defaults.global.defaultFontColor = "#FFFFFF";
    Chart.defaults.global.defaultFontSize = 16;
    Chart.defaults.global.defaultFontFamily = "'Montserrat', sans-serif";
    
}

