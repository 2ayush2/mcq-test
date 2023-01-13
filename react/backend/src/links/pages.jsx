const questionsPages = {
  QUESTIONS: '/admin/questions',
  QUESTION_NEW: '/admin/questions/create'
};

const sitePage = {
  LOGIN: '/admin/guest'
};

const pages = {
  BASE_URL: '/api',
  // BASE_URL: "http://ventvoila.com/api/admin",
  // BASE_URL: 'http://localhost:8000/api/',
  // LOCAL_URL: "http://localhost:3000",
  GUEST: '/admin/guest',
  HOME: questionsPages.QUESTIONS,
  ...sitePage,
  ...questionsPages
};

const guestPage = [pages.LOGIN];

const getFullUrl = (page) => {
  return pages.LOCAL_URL + '#' + page;
};

export { pages, sitePage, questionsPages, guestPage, getFullUrl };
