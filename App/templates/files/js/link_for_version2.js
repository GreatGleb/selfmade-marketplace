let links = document.getElementsByTagName('a');

for(let oneLink of links) {
	let oldLink = oneLink.href;
	if(oldLink.slice(0, 23) == "https://dev.saterno.ru/") {
		let indexSleshOfLink = nth_occurrence(oldLink, '/', 3);
		let subDomen = "version2";
		let newHref;
		if(oldLink.indexOf(subDomen) == -1) {
			if(indexSleshOfLink > -1) {
				newHref = oldLink.slice(0, indexSleshOfLink+1) + subDomen + oldLink.slice(indexSleshOfLink);
			}
			oneLink.href = newHref;
		}
	}
}

function nth_occurrence (string, char, nth) {
    var first_index = string.indexOf(char);
    var length_up_to_first_index = first_index + 1;

    if (nth == 1) {
        return first_index;
    } else {
        var string_after_first_occurrence = string.slice(length_up_to_first_index);
        var next_occurrence = nth_occurrence(string_after_first_occurrence, char, nth - 1);

        if (next_occurrence === -1) {
            return -1;
        } else {
            return length_up_to_first_index + next_occurrence;  
        }
    }
}