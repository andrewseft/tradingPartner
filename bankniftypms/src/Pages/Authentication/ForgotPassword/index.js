import React, { lazy } from "react"
import { Container, Row, Col, Form } from "react-bootstrap"
import { useForm } from "react-hook-form"
import { useSelector, useDispatch } from "react-redux"
import { forgotPassword } from "../../../actions/userActions"
import TextField from "@material-ui/core/TextField"
import { NavLink, Link } from "react-router-dom"
import { useHistory } from "react-router-dom"
const Button = lazy(() => import("../../../Component/Button"))
const Breadcrumb = lazy(() => import("../../../Component/Breadcrumb"))

const Index = (props) => {
  const { push } = useHistory()
  const dispatch = useDispatch()
  const { userParams } = useSelector((state) => ({
    userParams: state.userParams,
  }))
  const { register, errors, handleSubmit } = useForm({
    defaultValues: userParams,
  })

  const onSubmit = (data) => {
    dispatch(forgotPassword(data, push))
  }

  return (
    <>
      <Breadcrumb {...props} />
      <section className="login_sec">
        <Container>
          <Row>
            <Col lg={5} md={5} sm={8} className="m-auto">
              <div className="login_round">
                <Form onSubmit={handleSubmit(onSubmit)}>
                  <Link to="/">
                    <img src="./assets/img/logo.png" alt="logo" />
                  </Link>
                  <Form.Group controlId="formBasicEmail" className="pt-5">
                    <TextField
                      variant="outlined"
                      id="outlined-email"
                      label="Email Address*"
                      className="w-100"
                      error={errors.email ? true : false}
                      name="email"
                      inputRef={register({
                        required: "Please enter your email address",
                        pattern: {
                          value: /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i,
                          message: "Invalid email address",
                        },
                        maxLength: {
                          value: 50,
                          message: "Email should not exceed 50 characters.",
                        },
                      })}
                      helperText={errors.email && errors.email.message}
                      autoFocus={true}
                    />
                  </Form.Group>
                  <div className="login_btn">
                    <Button
                      title={"Submit"}
                      className={"btn btn-primary shadow-2  mt-3  w-100"}
                    />
                    <p className="mt-5">
                      Already have an account ?
                      <NavLink exact to="/login">
                        &nbsp;Sign in
                      </NavLink>
                    </p>
                  </div>
                </Form>
              </div>
            </Col>
          </Row>
        </Container>
      </section>
    </>
  )
}

export default Index
