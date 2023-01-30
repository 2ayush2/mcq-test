import { pages } from 'links';
import { Route, Switch } from 'react-router-dom';
import Status404 from 'view/pages/Status404';
import QuestionsController from './questions';
import QuestionsBank from './questionBank/view/list';

function MainController() {
  return (
    <div key="MainController">
      <Switch>
        <Route path={pages.QUESTION_BANK} component={QuestionsBank} />
        <Route path={pages.QUESTIONS} component={QuestionsController} />
        <Route path="*" component={Status404} />
      </Switch>
    </div>
  );
}

export default MainController;
