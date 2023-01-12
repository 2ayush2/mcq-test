import { Suspense, lazy } from 'react';
import { Navigate } from 'react-router-dom';

import SidebarLayout from 'layouts/SidebarLayout';
import BaseLayout from 'layouts/BaseLayout';

import SuspenseLoader from 'components/SuspenseLoader';
import { pages } from 'links';

const Loader = (Component) => (props) =>
(
  <Suspense fallback={<SuspenseLoader />}>
    <Component {...props} />
  </Suspense>
);

// Pages

const Students = Loader(lazy(() => import('view/main/student/view/list')));
const SiteController = Loader(lazy(() => import('view/site')));

const routes = [
  {
    path: pages.GUEST,
    element: <BaseLayout />,
    children: [
      {
        path: pages.GUEST,
        element: <SiteController />
      },
    ]
  },
  {
    path: pages.HOME,
    element: <SidebarLayout />,
    children: [
      {
        path: pages.HOME,
        element: <Students />
      }
    ]
  }
];

export default routes;
