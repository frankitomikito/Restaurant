$(document).ready(function() {
    const table = $('#table_id').DataTable({
                    ajax: `${RequestPath.getPath()}/api/reservation.php?datatable=true`,
                    dataSrc: 'data',
                    columns: [{
                            data: 0
                        },
                        {
                            data: 1,
                            render: function(data) {
                                return moment(data).format('MMMM DD, YYYY - h:mm A');
                            }
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
                                    ? moment(row[1]) > moment() || moment(row[1]).add(30, 'm') > moment() 
                                    && moment(row[1]) < moment().add(30, 'm') ? data : 2 : parseInt(data);
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
  await fetch(`${RequestPath.getPath()}/api/reservation.php?cancel=true`, {
    method: "POST",
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