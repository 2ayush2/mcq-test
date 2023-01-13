const questionsPages = {
    WELCOME: "/student/test/:code",
    QUESTIONS: "/student/begin",
};

const pages = {
    // BASE_URL: "/api",
    // BASE_URL: "http://ventvoila.com/api/admin",
    BASE_URL: "http://localhost:8000/",
    // LOCAL_URL: "http://localhost:3000",
    HOME: "#",
    ...questionsPages,
};

const guestPage = [pages.LOGIN];

const getFullUrl = (page) => {
    return pages.LOCAL_URL + "#" + page;
};

export { pages, questionsPages, guestPage, getFullUrl };
