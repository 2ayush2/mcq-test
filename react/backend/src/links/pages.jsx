
const questionsPages = {
    QUESTIONS: "/",
    QUESTION_NEW: "/create",
}

const sitePage = {
    LOGIN: "/guest",
}

const pages = {
    // BASE_URL: "/api",
    // BASE_URL: "http://ventvoila.com/api/admin",
    BASE_URL: "http://localhost:8000/api/",
    // LOCAL_URL: "http://localhost:3000",
    GUEST: "/guest",
    HOME: "/",
    ...sitePage,
    ...questionsPages,
};

const guestPage = [
    pages.LOGIN,
];

const getFullUrl = (page) => {
    return pages.LOCAL_URL + "#" + page;
}

export { pages, sitePage,  questionsPages, guestPage, getFullUrl };