/*form.addEventListener('submit', function(e){
    e.preventDefault();

});*/
// Defining a function to validate form
function validateForm() {
    // Retrieving the values of form elements
    let name = form.name.value;
    let birth_year = form.birth_year.value;
    let hair_color = form.hair_color.value;
    let height = form.height.value;
    let mass = form.mass.value;
    let gender_id = form.gender_id.value;
    let homeworld_id = form.homeworld_id.value;
    let url = form.url.value;

    // Defining error variables with a default value
    let nameErr =
        heightErr =
            massErr =
                birth_yearErr =
                    hair_colorErr =
                        gender_idErr =
                            homeworld_idErr =
                                urlErr = true;

    // Validate name
    if (isEmpty(name)) {
        printError("nameErr", "Please enter a name");
    } else if (!isSymbolsNumberCorrect(name.length, 3, 20)) {
        printError("nameErr", "Please check symbols number");
    } else {
        let regexName = /^[a-zA-Z\s]+$/;
        if (regexName.test(name) === false) {
            printError("nameErr", "Please enter a valid name");
        } else {
            printError("nameErr", "");
            nameErr = false;
        }
    }


    // Validate birth_year
    if (isEmpty(birth_year)) {
        printError("birth_yearErr", "Please enter a birth year");
    } else {
        let regexBirthYear = /^[0-9]{4}$/;
        if (regexBirthYear.test(birth_year) === false) {
            printError("birth_yearErr", "Please enter a year in current correct format");
        } else if (!isYearValid(birth_year)) {
            printError("birth_yearErr", "Incorrect year");
        } else {
            printError("birth_yearErr", "");
            birth_yearErr = false;
        }
    }


    // Validate height
    let regexHeight = /^[0-9]*$/;
    if (regexHeight.test(height) === false) {
        printError("heightErr", "Please enter valid height");
    } else {
        printError("heightErr", "");
        heightErr = false;
    }


    // Validate mass
    let regexMass = /^[0-9]*$/;
    if (regexMass.test(mass) === false) {
        printError("massErr", "Please enter valid weight");
    } else {
        printError("massErr", "");
        massErr = false;
    }


    // Validate hair_color
    let regexHair = /^[a-zA-Z\s\/]*$/;
    if (regexHair.test(hair_color) === false) {
        printError("hair_colorErr", "Please enter a valid hair color value");
    } else {
        printError("hair_colorErr", "");
        hair_colorErr = false;
    }


    // Validate gender_id
    if (isEmpty(gender_id)) {
        printError("gender_idErr", "Please enter a gender");
    } else {
        let regexGender = /^[0-9]$/;
        if (regexGender.test(gender_id) === false) {
            printError("gender_idErr", "Please enter a valid gender");
        } else {
            printError("gender_idErr", "");
            gender_idErr = false;
        }
    }


    // Validate gender_id
    if (isEmpty(homeworld_id)) {
        printError("homeworld_idErr", "Please enter a homeworld");
    } else {
        let regexHomeworld = /^[0-9]{1,2}$/;
        if (regexHomeworld.test(homeworld_id) === false) {
            printError("homeworld_idErr", "Please enter a valid homeworld");
        } else {
            printError("homeworld_idErr", "");
            homeworld_idErr = false;
        }
    }


    // Validate url

        if (url !== '' && !isValidUrl(url)) {
            printError("urlErr", "Please enter a valid url");
        } else {
            printError("urlErr", "");
            urlErr = false;
        }


    // Prevent the form from being submitted if there are any errors
    if ((
            nameErr ||
            heightErr ||
            massErr ||
            birth_yearErr ||
            hair_colorErr ||
            gender_idErr ||
            homeworld_idErr ||
            urlErr
        ) === true) {
        return false;
    }

// Defining a function to display error message
    function printError(elemId, hintMsg) {
        document.getElementById(elemId).innerHTML = hintMsg;
    }
}


function isValidUrl(url)
{
    let regex = /(http|https):\/\/(\w+:{0,1}\w*)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%!\-\/]))?/;
    return regex.test(url) === true;
}

const isEmpty = value => value === '';
const isSymbolsNumberCorrect = (length, min, max) => (length >= min && length <= max);
const isYearValid = (year) => year <= new Date().getFullYear();


/*


const isRequired = value => value !== '';
const isBetween = (length, min, max) => !(length < min || length > max);




form.addEventListener('submit', function (e) {
    e.preventDefault();
    checkRequired(res);
    checkLength(name, 3, 10);

});

function checkRequired(res) {
    res.forEach(function (value, key) {
        if (!isRequired(value)) {
            alert(key + " field can't be blank");
            return false;
        }
    });
}

function checkLength(res1, min, max) {
    if (!isBetween(res1, min, max)) {
        alert(res1[key] + " has wrong symbols number");
    }
}
*/
