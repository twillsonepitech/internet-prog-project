let _isNext = true;
let clickCount = 0;

function validateEventDetails() {
    // Get values from form fields
    var occasion = document.getElementById('occasion');
    var location = document.getElementById('location');
    var event_address = document.getElementById('event_address');
    var event_date = document.getElementById('event_date');
    var event_time = document.getElementById('event_time');
    var budget = document.getElementById('budget');
    var nbPax = document.getElementById('nbPax');

    // Initialize error variables
    var occasion_err = "";
    var location_err = "";
    var event_address_err = "";
    var event_date_err = "";
    var event_time_err = "";
    var budget_err = "";
    var nbPax_err = "";

    // Validation for each field
    if (occasion.value === "") {
        occasion_err = "Occasion is required";
    }

    if (location.value === "") {
        location_err = "Location is required";
    }

    if (event_address.value === "") {
        event_address_err = "Event Address is required";
    }

    if (event_date.value === "") {
        event_date_err = "Event Date is required";
    }

    if (event_time.value === "") {
        event_time_err = "Event Time is required";
    }

    if (budget.value === "") {
        budget_err = "Budget is required";
    } else if (isNaN(budget.value) || parseFloat(budget.value) < 0) {
        budget_err = "Invalid budget value";
    }

    if (nbPax.value === "") {
        nbPax_err = "Number of Pax is required";
    } else if (isNaN(nbPax.value) || parseInt(nbPax.value) < 0) {
        nbPax_err = "Invalid number of Pax value";
    }

    // Check if any error occurred
    if (occasion_err !== "" || location_err !== "" || event_address_err !== "" ||
        event_date_err !== "" || event_time_err !== "" || budget_err !== "" || nbPax_err !== "") {
        // error occurred
        _isNext = false;
        Swal.fire({
            icon: "warning", 
            title: "Oops...",
            text: "Please make sure fields are filled properly !",
            confirmButtonColor: "#ff5e00",
        });
        if (occasion.value === "") {
            occasion.style.border = "2px solid red";
        } else {
            occasion.style.border = "";
        }
    
        if (location.value === "") {
            location.style.border = "2px solid red";
        } else {
            location.style.border = "";
        }
    
        if (event_address.value === "") {
            event_address.style.border = "2px solid red";
        } else {
            event_address.style.border = "";
        }
    
        if (event_date.value === "") {
            event_date.style.border = "2px solid red";
        } else {
            event_date.style.border = "";
        }
    
        if (event_time.value === "") {
            event_time.style.border = "2px solid red";
        } else {
            event_time.style.border = "";
        }
    
        if (budget.value === "") {
            budget.style.border = "2px solid red";
        } else if (isNaN(budget.value) || parseFloat(budget.value) < 0) {
            budget.style.border = "2px solid red";
        } else {
            budget.style.border = "";
        }
    
        if (nbPax.value === "") {
            nbPax.style.border = "2px solid red";
        } else if (isNaN(nbPax.value) || parseInt(nbPax.value) < 0) {
            nbPax.style.border = "2px solid red";
        } else {
            nbPax.style.border = "";
        }
    } else {
        // no errors
        _isNext = true;
        Swal.fire({
            position: "center",
            icon: "success",
            title: "Event details have been saved",
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
        });
    }
}

function validateContactDetails() {
    // Get values from form fields
    var name = document.getElementById('name');
    var email = document.getElementById('email');
    var company = document.getElementById('company');
    var phone = document.getElementById('phone');

    // Initialize error variables
    var name_err = "";
    var email_err = "";
    var company_err = "";
    var phone_err = "";

    // Validation for each field
    if (name.value === "") {
        name_err = "Name is required";
    } else if (/\d/.test(name.value)) {
        name_err = "Name cannot contain numbers";
    }

    if (email.value === "") {
        email_err = "Email is required";
    } else if (!validateEmail(email.value)) {
        email_err = "Invalid email format";
    }

    if (company.value === "") {
        company_err = "Company is required";
    }

    if (phone.value === "") {
        phone_err = "Phone Number is required";
    } else if (!validatePhone(phone.value)) {
        phone_err = "Invalid phone format";
    }

    // Check if any error occurred
    if (name_err !== "" || email_err !== "" || company_err !== "" || phone_err !== "") {
        // error occurred
        _isNext = false;
        Swal.fire({
            icon: "warning",
            title: "Oops...",
            text: "Please make sure fields are filled properly !",
            confirmButtonColor: "#ff5e00",
        });
        if (name.value === "") {
            name.style.border = "2px solid red";
        } else if (/\d/.test(name.value)) {
            name.style.border = "2px solid red"
        }
    
        if (email.value === "") {
            email.style.border = "2px solid red"
        } else if (!validateEmail(email.value)) {
            email.style.border = "2px solid red"
        }
    
        if (company.value === "") {
            company.style.border = "2px solid red"
        }
    
        if (phone.value === "") {
            phone.style.border = "2px solid red"
        } else if (!validatePhone(phone.value)) {
            phone.style.border = "2px solid red"
        }
    } else {
        // no errors
        _isNext = true;
        Swal.fire({
            icon: "success",
            title: "Contact details have been saved",
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
        });
    }
}

// Function to validate email format
function validateEmail(email) {
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Function to validate phone format
function validatePhone(phone) {
    var phoneRegex = /^\d{10}$/;
    return phoneRegex.test(phone);
}

function deleteEventDetails() {
    Swal.fire({
        title: "Be careful...",
        text: "Are you sure you want to delete event details ?",
        icon: "warning",
        showCloseButton: true,
        confirmButtonColor: "#ff5e00",
        confirmButtonText: "Yes, delete it !"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('occasion').value = "";
            document.getElementById('location').value = "";
            document.getElementById('event_address').value = "";
            document.getElementById('event_date').value = "";
            document.getElementById('event_time').value = "";
            document.getElementById('budget').value = "";
            document.getElementById('nbPax').value = "";

            document.getElementById('occasion').style.border = "";
            document.getElementById('location').style.border = "";
            document.getElementById('event_address').style.border = "";
            document.getElementById('event_date').style.border = "";
            document.getElementById('event_time').style.border = "";
            document.getElementById('budget').style.border = "";
            document.getElementById('nbPax').style.border = "";
            Swal.fire({
                title: "Deleted !",
                text: "Event details has been deleted.",
                icon: "success",
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
            });
        }
    });
}

function deleteContactDetails() {
    Swal.fire({
        title: "Be careful...",
        text: "Are you sure you want to delete contact details ?",
        icon: "warning",
        showCloseButton: true,
        confirmButtonColor: "#ff5e00",
        confirmButtonText: "Yes, delete it !"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('name').value = "";
            document.getElementById('email').value = "";
            document.getElementById('company').value = "";
            document.getElementById('phone').value = "";

            document.getElementById('name').style.border = "";
            document.getElementById('email').style.border = "";
            document.getElementById('company').style.border = "";
            document.getElementById('phone').style.border = "";
            Swal.fire({
                title: "Deleted !",
                text: "Contact details has been deleted.",
                icon: "success",
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
            });
        }
    });
}

function deleteOtherDetails() {
    Swal.fire({
        title: "Be careful...",
        text: "Are you sure you want to delete other details ?",
        icon: "warning",
        showCloseButton: true,
        confirmButtonColor: "#ff5e00",
        confirmButtonText: "Yes, delete it !"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('requests').value = "";
            document.getElementById('promoCode').value = "";
            document.getElementById('subscription').checked = false;
            Swal.fire({
                title: "Deleted !",
                text: "Other details has been deleted.",
                icon: "success",
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
            });
        }
    });
}

function deleteInfo(order_id) {
    Swal.fire({
        title: "Deleted !",
        text: "Order id n°" + order_id + " has been deleted.",
        icon: "success",
        showConfirmButton: false,
        timer: 2000,
    });
}

const DOMstrings = {
    stepsBtnClass: 'multisteps-form__progress-btn',
    stepsBtns: document.querySelectorAll(`.multisteps-form__progress-btn`),
    stepsBar: document.querySelector('.multisteps-form__progress'),
    stepsForm: document.querySelector('.multisteps-form__form'),
    stepsFormTextareas: document.querySelectorAll('.multisteps-form__textarea'),
    stepFormPanelClass: 'multisteps-form__panel',
    stepFormPanels: document.querySelectorAll('.multisteps-form__panel'),
    stepPrevBtnClass: 'js-btn-prev',
    stepNextBtnClass: 'js-btn-next'
};

const removeClasses = (elemSet, className) => {

    elemSet.forEach(elem => {

        elem.classList.remove(className);

    });

};

const findParent = (elem, parentClass) => {

    let currentNode = elem;

    while (!currentNode.classList.contains(parentClass)) {
        currentNode = currentNode.parentNode;
    }

    return currentNode;

};

const getActiveStep = elem => {
    return Array.from(DOMstrings.stepsBtns).indexOf(elem);
};

const setActiveStep = activeStepNum => {

    removeClasses(DOMstrings.stepsBtns, 'js-active');

    DOMstrings.stepsBtns.forEach((elem, index) => {

        if (index <= activeStepNum) {
            elem.classList.add('js-active');
        }

    });
};

const getActivePanel = () => {

    let activePanel;

    DOMstrings.stepFormPanels.forEach(elem => {

        if (elem.classList.contains('js-active')) {

            activePanel = elem;

        }

    });

    return activePanel;

};

const setActivePanel = activePanelNum => {

    removeClasses(DOMstrings.stepFormPanels, 'js-active');

    DOMstrings.stepFormPanels.forEach((elem, index) => {
        if (index === activePanelNum) {

            elem.classList.add('js-active');

            setFormHeight(elem);

        }
    });

};

const formHeight = activePanel => {

    const activePanelHeight = activePanel.offsetHeight;

    DOMstrings.stepsForm.style.height = `${activePanelHeight}px`;

};

const setFormHeight = () => {
    const activePanel = getActivePanel();

    formHeight(activePanel);
};

DOMstrings.stepsBar.addEventListener('click', e => {

    const eventTarget = e.target;

    if (!eventTarget.classList.contains(`${DOMstrings.stepsBtnClass}`)) {
        return;
    }

    const activeStep = getActiveStep(eventTarget);

    setActiveStep(activeStep);

    setActivePanel(activeStep);
});

DOMstrings.stepsForm.addEventListener('click', e => {

    const eventTarget = e.target;

    if (!(eventTarget.classList.contains(`${DOMstrings.stepPrevBtnClass}`) || eventTarget.classList.contains(`${DOMstrings.stepNextBtnClass}`))) {
        return;
    }

    const activePanel = findParent(eventTarget, `${DOMstrings.stepFormPanelClass}`);

    let activePanelNum = Array.from(DOMstrings.stepFormPanels).indexOf(activePanel);

    if (eventTarget.classList.contains(`${DOMstrings.stepPrevBtnClass}`)) {
        activePanelNum--;

    } else {
        if (_isNext === true)
            activePanelNum++;

    }

    setActiveStep(activePanelNum);
    setActivePanel(activePanelNum);

});

window.addEventListener('load', setFormHeight, false);

window.addEventListener('resize', setFormHeight, false);


const setAnimationType = newType => {
    DOMstrings.stepFormPanels.forEach(elem => {
        elem.dataset.animation = newType;
    });
};

//changing animation
const animationSelect = document.querySelector('.pick-animation__select');

animationSelect.addEventListener('change', () => {
    const newAnimationType = animationSelect.value;

    setAnimationType(newAnimationType);
});
