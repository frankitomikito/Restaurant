let table;

initDatatable();

function initDatatable() {
  $(document).ready(function() {
    table = $("#table_id").DataTable({
      ajax: "http://localhost:8000/api/reservation.php?cashier=true",
      dataSrc: "data",
      columns: [
        {
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
          data: 4
        },
        {
          data: 5,
          render: function(data, type, row) {
              data = data != 1 && data != 3 && data != 4 
                  ? moment(row[1]).add(30, 'm') > moment() && moment(row[1]) < moment().add(30, 'm')  ? data : 2 : parseInt(data);
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

    $("#table_id tbody").on("click", "tr", function() {
      var data = table.row(this).data();
      if (data[5] == 0 && moment(data[1]).add(30, 'm') > moment() && moment(data[1]) < moment().add(30, 'm')) {
        const is_cancel_booking = confirm(
          "Do you want to confirm this booking? Press Ok if yes."
        );
        if (is_cancel_booking) {
          confirmBooking(data, table);
        }
      }
    });
  });
}

async function confirmBooking(data, table) {
  const form_data = new FormData();
  form_data.append('booking_id', data[0]);
  await fetch("http://localhost:8000/api/reservation.php", {
    method: "PUT",
    body: form_data,
  }).then(async (result) => {
    const result_json = await result.json();
      if (result_json.data == 'Success') {
        alert('Booking Confirmed Successfully!');
        table.ajax.reload();
      } 
      else 
        alert(result_json.error);
  }, async (error) => {
    const result_json = await error.json();
    console.log(result_json);
  });
}
