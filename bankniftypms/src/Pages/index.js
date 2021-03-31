import React from "react"
import { Route, Switch, Redirect } from "react-router-dom"
import { Routes } from "../Route/route"
import Header from "./Partial/Header"
import Footer from "./Partial/Footer"
import HomePage from "./Home"
import NotFoundPage from "./NotFound"

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
      <RouteWithHeader
        exact
        path={Routes.Home.path}
        component={HomePage}
        title={Routes.Home.name}
      />
      <RouteWithHeader
        exact
        path={Routes.Offer.path}
        component={HomePage}
        title={Routes.Offer.name}
      />
      <RouteWithHeader
        exact
        path={Routes.About.path}
        component={HomePage}
        title={Routes.About.name}
      />
      <RouteWithHeader
        exact
        path={Routes.Features.path}
        component={HomePage}
        title={Routes.Features.name}
      />
      <RouteWithHeader
        exact
        path={Routes.NotFound.path}
        component={NotFoundPage}
        title={Routes.Home.name}
      />
      <Redirect to={Routes.NotFound.path} />
    </Switch>
  )
}

export default Index
