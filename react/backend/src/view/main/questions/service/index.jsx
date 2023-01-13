import { getJsonForms } from '_services';
import { getApiRequest as getApi, getJsonForm } from '_services';

const getApiRequest = async (requestData) => {
  const result = await getApi({
    ...requestData
  })
    .then(function (response) {
      return {
        flag: true,
        headers: response.headers,
        status: response.status,
        message: 'Success',
        data: response.data
      };
    })
    .then(function (finalJson) {
      return finalJson;
    })
    .catch((error) => {
      // console.log(error)
      return {
        flag: false,
        status: error.response?.status,
        message: 'Error',
        data: error.response?.data
      };
    });
  return result;
};

async function getQuestionList(pages) {
  return await getApiRequest({
    url: '/questions',
    data: {
      ...pages
    }
  }).then((result) => {
    return result;
  });
}

async function createQuestion(data) {
  return await getApiRequest({
    url: '/questions/',
    method: 'POST',
    data: data
  }).then((result) => {
    return result;
  });
}

async function sendMail(id) {
  return await getApiRequest({
    url: '/questions/email/' + id
  }).then((result) => {
    return result;
  });
}

export { getQuestionList, createQuestion, sendMail };
