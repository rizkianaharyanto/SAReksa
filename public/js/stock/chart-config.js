const months = [
    "Jan",
    "Feb",
    "Mar",
    "Apr",
    "May",
    "Jun",
    "Jul",
    "Aug",
    "Sep",
    "Okt",
    "Nov",
    "Des"
];

var data = {
    labels: months,
    datasets: [
        {
            label: "PENJUALAN BARANG",
            data: [12, 19, 3, 5, 2, 3, 12, 19, 3, 5, 2, 3],
            backgroundColor: "rgba(13, 211, 220)",
     
        }
    ]
};
var options = {
    cornerRadius: 30,
    scales: {
        yAxes: [{
            ticks: {
                beginAtZero:true
            }
        }]
    },
    legend: {
        labels: {
            defaultFontColor: "#666"
        }
    },
    defaultFontSize: 14,
    maintainAspectRatio: false,
    scales: {
        yAxes: [
            {
                ticks: {
                    beginAtZero: true
                }
            }
        ]
    }
};
