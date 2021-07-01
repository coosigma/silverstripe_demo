function validateName(name) {
    const re = /\w+/;
    return re.test(name);
}
function validateEmail(email) {
    const re =
        /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/;
    return re.test(email);
}
function getInputValue(ele, name) {
    return ele.querySelector(`input[name="${name}"]`).value;
}
function handleErrors(response) {
    if (!response.ok) {
        throw Error(response.statusText);
    }
    return response.json();
}
const aPost = async (url = "", data = {}) => {
    try {
        const res = await fetch(url, {
            method: "POST",
            body: JSON.stringify(data),
        });
        return handleErrors(res);
    } catch (err) {
        console.log(err);
    }
};
function subscribe(ele) {
    const form = ele.parentNode;
    const name = getInputValue(form, "name");
    const company = getInputValue(form, "company");
    const email = getInputValue(form, "email");
    const result = form.parentNode.querySelector(".result");
    let message;
    // if (!validateName(name)) {
    // 	message = 'Please input a valid Name.';
    // }
    // if (!validateName(company)) {
    // 	message = 'Please input a valid Company.';
    // }
    // if (!validateEmail(email)) {
    // 	message = 'Please input a valid Email.';
    // }
    if (message) {
        result.innerHTML = message;
        return;
    }
    const url = `${window.location.origin}/api/subscribe`;
    const data = { name, company, email };
    const res = aPost(url, data);
    res.then((data) => console.log("data: ", data)).catch((error) => {
        console.log("error", error);
    });
}
