import React from "react"
import { Route, Switch, Redirect } from "react-router-dom"
import { RoutesPage } from "../Route/route"
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

const Index = () => {
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
      <Redirect to="/404" />
    </Switch>
  )
}

export default Index
