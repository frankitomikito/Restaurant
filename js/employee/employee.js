		class Users {
			static getPositionString(value) {
				switch(value) {
					case '3':
						return 'Chef';
					case '4':
						return 'Waiter';
				}
			}
			static getStatusString(value) {
				switch(value) {
					case '1':
						return 'Active';
					case '0':
						return 'InActive';
				}
			} 
		}

		async function setDataTableValue() {
			let response = await fetch('http://localhost:8000/apis/user?returnType=datatable');
			if (response.ok) {
			  let json = await response.json();
			  changeIntegerToText(json);
				const table = $('#datatable-tabletoolss').DataTable({
				    data: json,
				    columnDefs: [
			            { width: 100, targets: 0 },
			            { width: 40, targets: 3 },
			            { width: 40, targets: 5 },
			            { width: 40, targets: 6 }
			        ]
				});

				$('#datatable-tabletoolss').on('click', 'tr', function () {
			        const data = table.row(this).data();
			        alert( 'You clicked on '+data[0]+'\'s row' );
			    });
			} else {
			  alert("HTTP-Error: " + response.status);
			}
		}

		function changeIntegerToText(json) {
			let users = [];
			for (let i = 0; i < json.length; i++) {
				let user = json[i];
				user[5] = Users.getPositionString(user[5]);
				user[6] = Users.getStatusString(user[6]);
			}
		}

		setDataTableValue();