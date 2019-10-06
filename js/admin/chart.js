const ctx = document.getElementById("salesChart").getContext("2d");
const tsc = document.getElementById("todaySalesChart").getContext("2d");
const labels = [];
const data = [];
const date_time = new Date();
const current_month = date_time.toLocaleString('default', { month: 'long' });
let receipts;

document.getElementById('month_title').innerText = current_month.charAt(0).toUpperCase() + current_month.substring(1) + ' Sales Chart';

initReport();

function initReport() {
    monthSalesReport(() => {
        todaySalesReport();
    });
}

function todaySalesReport() {
    getSalesMenu(`${date_time.getFullYear()}-${date_time.getMonth() + 1}-${date_time.getDate()}`).then(
        result => {
            const menus = [];
            const menus_total = [];
            let today_total_sales = 0;
            result.forEach((value) => {
                menus.push(value.name);
                menus_total.push(value.total);
                today_total_sales += parseInt(value.total);
            });

            document.getElementById('totalSales').innerText = "Total Sales: ₱ " + today_total_sales;

            menus_total.push(0);
    
            var myBarChart = new Chart(tsc, {
                type: 'bar',
                data: {
                    labels: menus,
                    datasets: [
                        {
                            label: 'PHP',
                            backgroundColor: '#34495E',
                            borderColor: "#34495E",
                            data: menus_total
                        }
                    ]
                },
                options: {
                    scales: {
                        xAxes: [{
                            barPercentage: .5
                        }]
                    }
                }
            });
        }
    );
}

function monthSalesReport(callback) {
    getReceipts(current_month).then(
        result => {
            receipts = result;
            const first_receipt_date = new Date(receipts[0].date_ordered).getDate();
            const last_receipt_date = new Date(receipts[receipts.length - 1].date_ordered).getDate();
            for (let i = first_receipt_date; i < last_receipt_date + 1; i++) {
                labels.push(i);
    
                if ((last_receipt_date - first_receipt_date) === 0) {
                    data.push(0);
                    labels.push(labels[0]);
                }
    
                const receipt_date = receipts.filter(f => {
                    const date = new Date(f.date_ordered);
                    return date.getDate() == i;
                });
                let total = 0;
                receipt_date.forEach((value) => {
                    total += parseInt(value.total);
                });
                data.push(total);
            }
    
            const chart = new Chart(ctx, {
                // The type of chart we want to create
                type: "line",
    
                // The data for our dataset
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: current_month,
                            backgroundColor: '#34495E',
                            borderColor: "#0088CC",
                            data: data
                        }
                    ]
                },
    
                // Configuration options go here
                options: {
                }
            });
        }
    );

    callback();
}

async function getReceipts(month) {
    const result = await fetch(`http://localhost:8000/api/order.php?month=${month}`);
    if (result.ok) {
        return await result.json();
    } else {
        return [];
    }
}

async function getSalesMenu(date) {
    const result =  await fetch(`http://localhost:8000/api/order.php?date=${date}`);
    if (result.ok) {
        return await result.json();
    } else {
        return [];
    }
}