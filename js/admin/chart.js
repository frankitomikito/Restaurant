const ctx = document.getElementById("salesChart").getContext("2d");
const labels = [0];
const data = [];
const date_time = new Date();
let receipts;

getReceipts().then(
    result => {
        receipts = result;
        const first_receipt_date = new Date(receipts[0].date_ordered);
        const last_receipt_date = new Date(receipts[receipts.length - 1].date_ordered);
        for (let i = first_receipt_date.getDate(); i < last_receipt_date.getDate() + 1; i++) {
            labels.push(i);
            const receipt_date = receipts.filter(f => {
                const date = new Date(f.date_ordered);
            });
        }

        const chart = new Chart(ctx, {
            // The type of chart we want to create
            type: "line",

            // The data for our dataset
            data: {
                labels: labels,
                datasets: [
                    {
                        label: date_time.toLocaleString('default', { month: 'long' }),
                        backgroundColor: '#34495E',
                        borderColor: "#0088CC",
                        data: [0, 6000, 3000, 2567, 5000]
                    }
                ]
            },

            // Configuration options go here
            options: {
            }
        });
    }
);

async function getReceipts() {
    const result = await fetch('http://localhost:8000/apis/order?month=september');
    if (result.ok) {
        return await result.json();
    } else {
        return [];
    }
}