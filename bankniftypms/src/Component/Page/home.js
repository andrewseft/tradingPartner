import React from "react"
import { Button, Container, Row, Col, Form } from "react-bootstrap"

const Home = () => {
  return (
    <section className="banner_sec">
      <Container>
        <Row className="align-items-center">
          <Col lg={6} md={6}>
            <div className="banner_side_content">
              <h1>Banknifty PMS Customized Portfolio Management Service</h1>
              <p>Create Legacy Wealth</p>
              <div className="banner-holder mt-4">
                <a
                  href="#!"
                  onClick={(e) => {
                    e.preventDefault()
                  }}
                >
                  <img src="./assets/img/sing-in.png" alt="google" />
                </a>
                <a
                  href="#!"
                  onClick={(e) => {
                    e.preventDefault()
                  }}
                  className="pl-2"
                >
                  <img src="./assets/img/app-store.png" alt="apple" />
                </a>
              </div>
            </div>
          </Col>
          <Col lg={6} md={6}>
            <div className="banner_form">
              <h3>Get started for Free</h3>
              <p className="mb-4">
                App ipsum dolor sit amet, consectetur adipiscing elit, sed do
                eiusmod tempor incididunt ut labore et dolore magna aliqua.
              </p>
              <Form>
                <Form.Group controlId="formBasicEmail">
                  <Form.Control
                    type="text"
                    placeholder="Name"
                    className="banner_input"
                  />
                </Form.Group>
                <Form.Group controlId="formBasicEmail">
                  <Form.Control
                    type="email"
                    placeholder="Email"
                    className="banner_input"
                  />
                </Form.Group>
                <Form.Group controlId="formBasicEmail">
                  <Form.Control
                    type="text"
                    placeholder="Subject"
                    className="banner_input"
                  />
                </Form.Group>
                <Form.Group controlId="exampleForm.ControlTextarea1">
                  <Form.Control
                    as="textarea"
                    rows={8}
                    placeholder="Enter Message"
                  />
                </Form.Group>
                <Button variant="primary" type="submit">
                  Send Message
                </Button>
              </Form>
            </div>
          </Col>
        </Row>
      </Container>
    </section>
  )
}

export default Home
