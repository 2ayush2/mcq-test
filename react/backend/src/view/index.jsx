import React from 'react';
import { Route, Switch } from 'react-router-dom';
import { pages } from 'links/pages';
import MainController from 'view/main';
import SiteController from 'view/site';
import MainLayout from 'components/layouts';

function StoreController() {
  console.log('store');
  return (
    <MainLayout>
      <Switch>
        <Route path={pages.GUEST} exact component={SiteController} />
        <Route path={'/'} component={MainController} />
      </Switch>
    </MainLayout>
  );
}

export default StoreController;
