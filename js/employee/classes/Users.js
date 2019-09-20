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