import React, { lazy } from "react"
import { NavLink } from "react-router-dom"
const Breadcrumb = lazy(() => import("../../Component/Breadcrumb"))

const Index = (props) => {
  return (
    <div className="pt-5 page_not_found">
      <Breadcrumb {...props} />
      <center>
        <h1>This page is outside of the Universe</h1>
        <h4 className="pt-4">
          The page you are trying to access does not exist or has been moved.
          Try going back to our homepage.
        </h4>
        <div className="login-btn">
          <NavLink to="/" className="btn-3">
            Home
          </NavLink>
        </div>
      </center>
    </div>
  )
}

export default Index
