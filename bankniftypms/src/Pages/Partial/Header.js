import React from "react"
import { Navbar, Nav, Container } from "react-bootstrap"
import { Link, NavLink } from "react-router-dom"
const Header = () => {
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
              <div className="login-btn">
                <NavLink
                  className="btn-3"
                  exact
                  activeClassName="active"
                  to="/login"
                >
                  SignIn
                </NavLink>
                <Nav.Link href="/signup" className="btn-3">
                  SignUp
                </Nav.Link>
              </div>
            </Navbar.Collapse>
          </Navbar>
        </Container>
      </header>
    </>
  )
}
export default Header
