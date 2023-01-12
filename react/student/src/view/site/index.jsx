import { Route } from 'react-router-dom';
import { pages } from 'links/pages';
import Login from './view/Login';

function SiteController() {
  return <Route exact path={pages.LOGIN} component={Login} />;
}

export default SiteController;
