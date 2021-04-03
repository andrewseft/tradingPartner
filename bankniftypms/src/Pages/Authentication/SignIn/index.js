import React, { useState } from "react"
import { Container, Row, Col, Form } from "react-bootstrap"
import { useForm } from "react-hook-form"
import { connect } from "react-redux"
import { bindActionCreators } from "redux"
import * as userActions from "../../../actions/userActions"
import TextField from "@material-ui/core/TextField"
import IconButton from "@material-ui/core/IconButton"
import InputAdornment from "@material-ui/core/InputAdornment"
import Visibility from "@material-ui/icons/Visibility"
import VisibilityOff from "@material-ui/icons/VisibilityOff"
import Checkbox from "@material-ui/core/Checkbox"
import FormControlLabel from "@material-ui/core/FormControlLabel"
import Breadcrumb from "../../../Component/Breadcrumb"
import { NavLink } from "react-router-dom"
import Button from "../../../Component/Button"

const Index = (props) => {
  const { userParams, actions } = props
  const { register, errors, handleSubmit } = useForm({
    defaultValues: userParams,
  })

  const onSubmit = (data) => {
    actions.userLoginData(data)
  }
  const [values, setValues] = useState({
    password: false,
  })
  const handleClickShowPassword = () => {
    setValues({ ...values, password: !values.password })
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
                  <img src="./assets/img/logo.png" alt="logo" />
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
                  <Form.Group controlId="formBasicEmail">
                    <TextField
                      variant="outlined"
                      id="outlined-password"
                      label="Password*"
                      type={values.password ? "text" : "password"}
                      className="w-100"
                      error={errors.password ? true : false}
                      name="password"
                      inputRef={register({
                        required: "Please enter your password",
                      })}
                      helperText={errors.password && errors.password.message}
                      InputProps={{
                        endAdornment: (
                          <InputAdornment>
                            <IconButton onClick={handleClickShowPassword}>
                              {values.password ? (
                                <Visibility />
                              ) : (
                                <VisibilityOff />
                              )}
                            </IconButton>
                          </InputAdornment>
                        ),
                      }}
                    />
                  </Form.Group>
                  <div className="d-flex justify-content-between">
                    <div className="checkbox_login d-flex align-items-center">
                      <FormControlLabel
                        control={
                          <Checkbox
                            name="remember_me"
                            checked={userParams.remember_me}
                            inputRef={register({})}
                          />
                        }
                        label="Remember me"
                      />
                    </div>
                    <div>
                      <NavLink exact to="/login">
                        Forget Password
                      </NavLink>
                    </div>
                  </div>
                  <div className="login_btn">
                    <Button
                      title={"Login"}
                      className={"btn btn-primary shadow-2  mt-3  w-100"}
                    />
                    <p className="mt-5">
                      Don't have an account?
                      <NavLink exact to="/register">
                        &nbsp;Sign Up
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
function mapStateToProps(state) {
  return {
    userParams: state.userParams,
  }
}

function mapDispatchToProps(dispatch) {
  return {
    actions: bindActionCreators(Object.assign(userActions), dispatch),
  }
}

export default connect(mapStateToProps, mapDispatchToProps)(Index)
