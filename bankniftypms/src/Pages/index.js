import React from "react"
import { Route, Switch, Redirect } from "react-router-dom"
import { RoutesPage, RoutesAuth } from "../Route/route"
import Header from "./Partial/Header"
import Footer from "./Partial/Footer"

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
        auth ? <Redirect to="/" /> : <Component {...props} title={rest.title} />
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
      <Redirect to="/404" />
    </Switch>
  )
}

export default Index
