import React from "react"
import { Navbar, Nav, Container } from "react-bootstrap"
import { useSelector, useDispatch } from "react-redux"
import { Link, NavLink } from "react-router-dom"
import { checkConform } from "../../utils/helpers"
import { userLogout } from "../../actions/userActions"
import { useHistory } from "react-router-dom"

const Header = () => {
  const { isAuth } = useSelector((state) => ({
    isAuth: state.isAuth,
  }))
  const { push } = useHistory()
  const dispatch = useDispatch()
  const handleLogout = (e) => {
    e.preventDefault()
    const afterLogoutCallback = () => {
      dispatch(userLogout(push))
    }
    checkConform(
      afterLogoutCallback,
      "Are you sure you want to logout account?"
    )
  }

  return (
    <>
      <header>
        <Container fluid className="is-sticky">
          <Navbar expand="lg">
            <Link to="/" className="logo">
              <img src="./assets/img/logo.png" alt="logo" />
            </Link>
            <Navbar.Toggle aria-controls="basic-navbar-nav" />
            <Navbar.Collapse id="basic-navbar-nav">
              <Nav className="m-auto">
                <NavLink
                  className="nav-link"
                  exact
                  activeClassName="active"
                  to="/"
                >
                  Home
                </NavLink>
                <NavLink
                  className="nav-link"
                  exact
                  activeClassName="active"
                  to="/what-we-offer"
                >
                  What We Offer
                </NavLink>
                <NavLink
                  className="nav-link"
                  exact
                  activeClassName="active"
                  to="/why-us"
                >
                  Why Us
                </NavLink>
                <NavLink
                  className="nav-link"
                  exact
                  activeClassName="active"
                  to="/features"
                >
                  Features
                </NavLink>
                <NavLink
                  className="nav-link"
                  exact
                  activeClassName="active"
                  to="/faq"
                >
                  FAQ'S
                </NavLink>
                <NavLink
                  className="nav-link"
                  exact
                  activeClassName="active"
                  to="/contact-us"
                >
                  Reach Us
                </NavLink>
                <NavLink
                  className="nav-link"
                  exact
                  activeClassName="active"
                  to="/download"
                >
                  Downloads
                </NavLink>
              </Nav>
              {!isAuth ? (
                <div className="login-btn">
                  <NavLink
                    className="btn-3"
                    exact
                    activeClassName="active"
                    to="/login"
                  >
                    SignIn
                  </NavLink>
                  <NavLink
                    className="btn-3"
                    exact
                    activeClassName="active"
                    to="/register"
                  >
                    SignUp
                  </NavLink>
                </div>
              ) : (
                <div className="login-btn">
                  <NavLink
                    className="btn-3"
                    exact
                    activeClassName="active"
                    to="/user/dashboard"
                  >
                    Dashboard
                  </NavLink>
                  <NavLink
                    className="btn-3"
                    to="#!"
                    onClick={(e) => handleLogout(e)}
                  >
                    Logout
                  </NavLink>
                </div>
              )}
            </Navbar.Collapse>
          </Navbar>
        </Container>
      </header>
    </>
  )
}
export default Header
