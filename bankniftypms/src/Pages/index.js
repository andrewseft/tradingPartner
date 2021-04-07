import React, { lazy } from "react"
import { Route, Switch, Redirect } from "react-router-dom"
import { RoutesPage, RoutesAuth, RoutesUser } from "../Route/route"
const Header = lazy(() => import("./Partial/Header"))
const Footer = lazy(() => import("./Partial/Footer"))
const Sidebar = lazy(() => import("./Partial/Sidebar"))
const UserHeader = lazy(() => import("./Partial/userHeader"))

const RouteWithHeader = ({ component: Component, ...rest }) => {
  return (
    <Route
      {...rest}
      render={(props) => (
        <>
          <Header />
          <Component {...props} title={rest.title} />
          <Footer />
        </>
      )}
    />
  )
}

const RouteWithAuth = ({ component: Component, isAuth: auth, ...rest }) => {
  return (
    <Route
      {...rest}
      render={(props) =>
        auth ? (
          <Redirect to="/user/dashboard" />
        ) : (
          <Component {...props} title={rest.title} />
        )
      }
    />
  )
}

const RouteWithUser = ({ component: Component, isAuth: auth, ...rest }) => {
  return (
    <Route
      {...rest}
      render={(props) =>
        auth ? (
          <>
            <div className="main_sidebar_nifty">
              <Sidebar />
              <div className="dashboard_inner">
                <UserHeader />
                <Component {...props} title={rest.title} />
              </div>
            </div>
          </>
        ) : (
          <Redirect to="/login" />
        )
      }
    />
  )
}

const Index = (props) => {
  return (
    <Switch>
      {RoutesPage.map((route, index) => (
        <RouteWithHeader
          key={index}
          exact
          path={route.path}
          component={route.component}
          title={route.title}
        />
      ))}
      {RoutesAuth.map((route, index) => (
        <RouteWithAuth
          key={index}
          exact
          path={route.path}
          component={route.component}
          title={route.title}
          isAuth={props.isAuth}
        />
      ))}
      {RoutesUser.map((route, index) => (
        <RouteWithUser
          key={index}
          exact
          path={route.path}
          component={route.component}
          title={route.title}
          isAuth={props.isAuth}
        />
      ))}
      <Redirect to="/404" />
    </Switch>
  )
}

export default Index
