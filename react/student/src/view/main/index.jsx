import { pages } from 'links';
import { Route, Switch } from 'react-router-dom';
import Status404 from 'view/pages/Status404';
import QuestionsController from './questions';

function MainController() {
  return (
    <div key="MainController">
      <Switch>
        <Route path={pages.QUESTIONS} component={QuestionsController} />
        <Route path="*" component={Status404} />
      </Switch>
    </div>
  );
}

export default MainController;
