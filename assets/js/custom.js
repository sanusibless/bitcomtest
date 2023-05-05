function array(arr) {
	for(let i = 0; i<arr.length; i++) {
		let num = arr[i];
		for(let j = i+1; j<arr.length; j++) {
			if(num == arr[j]) return num;
		}
	}
}