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
	static getGenderString(value) {
		switch (value) {
			case '1':
				return 'Male';
			case '0':
				return 'Female';
		}
	}
	static getGenderInt(value) {
		switch (value) {
			case 'Male':
				return '1';
			case 'Female':
				return '0';
		}
	}
	static getPositionInt(value) {
		switch (value) {
			case 'Chef':
				return '3';
			case 'Waiter':
				return '4';
		}
	}
	static getStatusInt(value) {
		switch (value) {
			case 'Active':
				return '1';
			case 'InActive':
				return '0';
		}
	}
}