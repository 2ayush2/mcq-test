import { Route } from 'react-router-dom';
import { questionsPages } from 'links';
import QuestionsList from './view/list';
import AddNew from './view/add';

function QuestionsController() {
  return (
    <>
      <Route exact path={questionsPages.QUESTIONS} component={QuestionsList} />
      <Route exact path={questionsPages.QUESTION_NEW} component={AddNew} />
    </>
  );
}

export default QuestionsController;
