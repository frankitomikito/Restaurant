$(document).ready(function() {
    const table = $('#table_id').DataTable({
                    ajax: 'http://localhost:8000/api/reservation.php?datatable=true',
                    dataSrc: 'data',
                    columns: [{
                            data: 0
                        },
                        {
                            data: 1
                        },
                        {
                            data: 2
                        },
                        {
                            data: 3
                        },
                        {
                            data: 4,
                            render: function(data, type, row) {
                                data = data != 1 && data != 3 && data != 4 
                                    ? new Date(row[1]) > new Date() ? data : 2 : parseInt(data);
                                console.log(data);
                                switch (data) {
                                    case 1:
                                        return 'Confirmed';
                                    case 2:
                                        return 'Expired';
                                    case 3:
                                        return 'Used';
                                    case 4:
                                        return 'Cancelled';
                                    default:
                                        return 'Pending';
                                }
                            }
                        }
                    ]
                });

    $('#table_id tbody').on('click', 'tr', function () {
        var data = table.row(this).data();
        if (data[4] == 0) {
            const is_cancel_booking = confirm('Do you want to cancel this booking? Press Ok if yes.');
            if (is_cancel_booking) {
                cancelBooking(data, table);
            }
        }
    });
});

async function cancelBooking(data, table) {
  const form_data = new FormData();
  form_data.append('booking_id', data[0]);
  await fetch("http://localhost:8000/api/reservation.php", {
    method: "DELETE",
    body: form_data,
  }).then(async (result) => {
    const result_json = await result.json();
      if (result_json.data == 'Success') {
        alert('Booking Cancelled Successfully!');
        table.ajax.reload();
      } 
      else 
        alert(result_json.error);
  }, async (error) => {
    const result_json = await error.json();
    console.log(result_json);
  });
}