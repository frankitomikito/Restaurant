$(document).ready(function() {
    const table = $('#table_id').DataTable({
                    ajax: 'http://localhost:8000/apis/reservation?datatable=true',
                    dataSrc: 'data',
                    columns: [{
                            data: 'booking_id'
                        },
                        {
                            data: 'check_in'
                        },
                        {
                            data: 'table_name'
                        },
                        {
                            data: 'capacity'
                        },
                        {
                            data: 'status',
                            render: function(data, type, row) {
                                switch (data) {
                                    case '1':
                                        return 'Confirmed'
                                    default:
                                        return 'Pending'
                                }
                            }
                        }
                    ]
                });

    $('#table_id tbody').on('click', 'tr', function () {
        var data = table.row(this).data();
        if (data.status != 1) {
            const is_cancel_booking = confirm('Do you want to cancel this booking? Press Ok if yes.');
            if (is_cancel_booking) {
                cancelBooking(data);
            }
        }
    });
});

async function cancelBooking(data) {
  const form_data = new FormData();
  form_data.append('booking_id', data.booking_id);
  await fetch("http://localhost:8000/apis/reservation", {
    method: "PUT",
    body: form_data,
  }).then(async (result) => {
      const result_json = await result.json();
      console.log(result_json);
  }, async (error) => {
    const result_json = await error.json();
    console.log(result_json);
  });
}