const sales_chart = document.getElementById("salesChart").getContext("2d");
const today_sales_chart = document.getElementById("todaySalesChart").getContext("2d");
const custom_chart_elem = document.getElementById("customChart").getContext("2d");
const custom_report_btn = document.getElementById('generateReport');
const labels = [];
const data = [];
const date_time = new Date();
const current_month = date_time.toLocaleString('default', { month: 'long' });
let receipts;
let custom_chart;
const date_from = document.getElementById('datefrom');
const date_to = document.getElementById('dateto');

document.getElementById('month_title').innerText = current_month.charAt(0).toUpperCase() + current_month.substring(1) + ' Sales Chart';

setCurrentDate();
initReport();

function initReport() {
    monthSalesReport(() => {
        todaySalesReport();
        customSalesChart();
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
    
            var myBarChart = new Chart(today_sales_chart, {
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
    
            const chart = new Chart(sales_chart, {
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

function customSalesChart(callback) {

    getSalesOrderFromTo(date_from.value, date_to.value).then(
        result => {
            const labels = [];
            const data = [];
            result.data.forEach(value => {
                if (result.data.length == 1) {
                    labels.push(moment(value.date_ordered).format('MMMM DD'));
                    data.push(0);
                }
                labels.push(moment(value.date_ordered).format('MMMM DD'));
                data.push(value.total);
             });
            custom_chart = new Chart(custom_chart_elem, {
                type: "line",
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: `Sales report as of ${formatDate(date_from)} to ${formatDate(date_to)}`,
                            backgroundColor: '#34495E',
                            borderColor: "#0088CC",
                            data: data
                        }
                    ]
                },
                options: {
                }
            });

            if(callback)
            callback();
        }
    );
}

async function getReceipts(month) {
    const result = await fetch(`https://tak-angrestaurant.000webhostapp.com/api/order.php?month=${month}`);
    if (result.ok) {
        return await result.json();
    } else {
        return [];
    }
}

async function getSalesMenu(date) {
    const result =  await fetch(`https://tak-angrestaurant.000webhostapp.com/api/order.php?date=${date}`);
    if (result.ok) {
        return await result.json();
    } else {
        return [];
    }
}

async function getSalesOrderFromTo(date_from, date_to) {
    const result = 
    await fetch(`https://tak-angrestaurant.000webhostapp.com/api/receipt.php?date_from=${date_from}&date_to=${date_to}`);
    if (result.ok) {
        return await result.json();
    } else {
        return [];
    }
}

function onDateFromChange(elem) {
    date_from.setAttribute('max', date_to.value);
    if (custom_report_btn.hasAttribute('disabled'))
        custom_report_btn.removeAttribute('disabled');
}

function onDateToChange(elem) {
    date_to.setAttribute('min', date_from.value);
    if (custom_report_btn.hasAttribute('disabled'))
        custom_report_btn.removeAttribute('disabled');
}

function generateCustomReport(elem) {
    elem.setAttribute('disabled', 'disabled');
    setButtonStatus('Please wait', 'wait');
    getSalesOrderFromTo(date_from.value, date_to.value).then(
        result => {
            if (result.data.length > 0) {
                const labels = [];
                const data = [];
                result.data.forEach(value => {
                    if (result.data.length == 1) {
                        labels.push(moment(value.date_ordered).format('MMMM DD'));
                        data.push(0);
                    }
                    labels.push(moment(value.date_ordered).format('MMMM DD'));
                    data.push(value.total);
                });
                setCustomChartData(labels, data);
            }
            else
                setCustomChartData([], []);

            setButtonStatus('Generate Report', 'pointer');
        }
    );
}

function setButtonStatus(text, cursor) {
    custom_report_btn.innerText = text;
    custom_report_btn.style.cursor = cursor;
}

function setCustomChartData(labels, data) {
    custom_chart.data = {
        labels: labels,
        datasets: [
            {
                label: `Sales report as of ${formatDate(date_from)} to ${formatDate(date_to)}`,
                backgroundColor: '#34495E',
                borderColor: "#0088CC",
                data: data
            }
        ]
    }
    custom_chart.update();
} 

function setCurrentDate() {
    const from_elem = document.getElementById('datefrom');
    const to_elem = document.getElementById('dateto');
    from_elem.setAttribute('value', today());
    from_elem.setAttribute('max', today());
    to_elem.setAttribute('value', today());
    to_elem.setAttribute('min', today());
}

function today() {
    let d = new Date();
    let currDate = d.getDate();
    let currMonth = d.getMonth()+1;
    let currYear = d.getFullYear();
    return currYear + "-" + ((currMonth<10) ? '0'+currMonth : currMonth )+ "-" + ((currDate<10) ? '0'+currDate : currDate );
}

function formatDate(date) {
    return moment(date).format('MMMM DD, YYYY');
}