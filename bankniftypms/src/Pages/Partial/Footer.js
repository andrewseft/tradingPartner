import React from "react"
import { Container, Row, Col } from "react-bootstrap"
import { Link, NavLink } from "react-router-dom"
import { useSelector } from "react-redux"

const Footer = () => {
  const { setting } = useSelector((state) => ({
    setting: state.setting,
  }))
  return (
    <>
      <footer>
        <Container>
          <Row>
            <Col lg={4} md={5} sm={5}>
              <div className="footer_widget">
                <Link to="/" className="logo">
                  <img
                    src="./assets/img/logo.png"
                    alt="logo"
                    className="footer_f_image"
                  />
                </Link>

                <p className="mt-4">{setting.about_us}</p>
                <ul className="social-list">
                  <li>
                    <a
                      href="#!"
                      onClick={(e) => {
                        e.preventDefault()
                      }}
                    >
                      <i className="fab fa-facebook-f"></i>
                    </a>
                  </li>
                  <li>
                    <a
                      href="#!"
                      onClick={(e) => {
                        e.preventDefault()
                      }}
                    >
                      <i className="fab fa-twitter"></i>
                    </a>
                  </li>
                  <li>
                    <a
                      href="#!"
                      onClick={(e) => {
                        e.preventDefault()
                      }}
                    >
                      <i className="fab fa-linkedin-in"></i>
                    </a>
                  </li>
                  <li>
                    <a
                      href="#!"
                      onClick={(e) => {
                        e.preventDefault()
                      }}
                    >
                      <i className="fab fa-instagram"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </Col>

            <Col lg={4} md={3} sm={4}>
              <div className="footer_widget pl-md-5">
                <h3 className="">Company</h3>
                <ul className="list">
                  <li>
                    <NavLink to="/privacy-policy" activeClassName="active">
                      Privacy Policy
                    </NavLink>
                  </li>
                  <li>
                    <NavLink to="/cancellation-policy" activeClassName="active">
                      Cancellation Policy
                    </NavLink>
                  </li>
                  <li>
                    <NavLink to="/return-policy" activeClassName="active">
                      Return Policy
                    </NavLink>
                  </li>
                  <li>
                    <NavLink to="/terms-conditions" activeClassName="active">
                      Terms and Conditions
                    </NavLink>
                  </li>
                </ul>
              </div>
            </Col>

            <Col lg={4} md={4} sm={3}>
              <div className="footer_widget">
                <h3>Download</h3>
                <ul className="footer-holder">
                  <li>
                    <a
                      href="#!"
                      onClick={(e) => {
                        e.preventDefault()
                        window.open(setting.google_link, "_blank")
                      }}
                    >
                      <img
                        src="./assets/img/sing-in.png"
                        className="mb-2"
                        alt="google"
                      />
                    </a>
                  </li>
                  <li>
                    <a
                      href="#!"
                      onClick={(e) => {
                        e.preventDefault()
                        window.open(setting.apple_link, "_blank")
                      }}
                    >
                      <img src="./assets/img/app-store.png" alt="apple" />
                    </a>
                  </li>
                </ul>
              </div>
            </Col>
          </Row>
        </Container>

        <div className="copy-right">
          <div className="container">
            <div className="copy-right-text text-center">
              <p className="text-center"> {setting.copy_right} </p>
            </div>
          </div>
        </div>
      </footer>
    </>
  )
}

export default Footer
