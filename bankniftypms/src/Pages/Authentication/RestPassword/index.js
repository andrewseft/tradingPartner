import React, { useEffect, useState } from "react"
import { Link, NavLink, useHistory } from "react-router-dom"
import Button from "../../../Component/Button"
import { useForm } from "react-hook-form"
import { connect } from "react-redux"
import { bindActionCreators } from "redux"
import * as userActions from "../../../actions/userActions"
import { Container, Row, Form } from "react-bootstrap"
import TextField from "@material-ui/core/TextField"
import IconButton from "@material-ui/core/IconButton"
import InputAdornment from "@material-ui/core/InputAdornment"
import Visibility from "@material-ui/icons/Visibility"
import VisibilityOff from "@material-ui/icons/VisibilityOff"

const Index = (props) => {
  const { title, superUserParams, actions } = props
  const { push } = useHistory()
  const { register, errors, handleSubmit } = useForm({
    defaultValues: superUserParams,
  })
  useEffect(() => {
    document.title = title
    window.scrollTo({ top: 0, behavior: "smooth" })
  }, [title])

  const onSubmit = (data) => {
    actions.resetPassword(data, push)
  }

  const [values, setValues] = useState({
    password: false,
  })
  const handleClickShowPassword = () => {
    setValues({ ...values, password: !values.password })
  }

  return (
    <div className="create-account">
      <div className="align-middle">
        <Container>
          <Row>
            <div className="col-md-6 offset-md-3">
              <div className="login-account">
                <img
                  src="assets/images/shape1.png"
                  alt="logo"
                  className="shape1 custom-animation"
                />
                <img
                  src="assets/images/shape2.png"
                  alt="logo"
                  className="shape2 custom-animation"
                />
                <img
                  src="assets/images/shape3.png"
                  alt="logo"
                  className="shape3 custom-animation"
                />
                <div className="form-content">
                  <Form onSubmit={handleSubmit(onSubmit)}>
                    <div className="login-logo">
                      <Link to="/" className="logo m-0">
                        <img src="assets/images/login-logo.png" alt="logo" />
                      </Link>
                      <h5>RESET PASSWORD</h5>
                    </div>

                    <div className="checkout-form pt-0">
                      <TextField
                        variant="outlined"
                        id="outlined-otp"
                        label="OTP*"
                        className="w-100 mb-4"
                        error={errors.otp ? true : false}
                        name="otp"
                        inputRef={register({
                          required: "Please enter your OTP address",
                          minLength: {
                            value: 4,
                            message: "OTP should contain atleast 4 characters.",
                          },
                          maxLength: {
                            value: 4,
                            message: "OTP should not exceed 4 characters.",
                          },
                          pattern: {
                            value: /^[0-9\b]+$/i,
                            message: "OTP should be only numeric value",
                          },
                        })}
                        helperText={errors.otp && errors.otp.message}
                        size={"small"}
                      />

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
                          minLength: {
                            value: 6,
                            message:
                              "Password should contain atleast 6 characters.",
                          },
                          pattern: {
                            value: /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!()@$%^&*-]).{6,}$/i,
                            message:
                              "Password should contain at-least 1 Uppercase,1 Lowercase, 1 Numeric and 1 special character",
                          },
                        })}
                        helperText={errors.password && errors.password.message}
                        size={"small"}
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

                      <Button
                        title={"Submit"}
                        className={"btn btn-primary shadow-2  mt-3  w-100"}
                      />
                      <div className="col-md-12 text-center mt-5">
                        <NavLink to="/login" className="dont-have-account">
                          Back To Login
                        </NavLink>
                      </div>
                    </div>
                  </Form>
                </div>
              </div>
            </div>
          </Row>
        </Container>
      </div>
      <div id="navbar_scroll_fixed"></div>
    </div>
  )
}

function mapStateToProps(state) {
  return {
    superUserParams: state.superUserParams,
  }
}

function mapDispatchToProps(dispatch) {
  return {
    actions: bindActionCreators(Object.assign(userActions), dispatch),
  }
}

export default connect(mapStateToProps, mapDispatchToProps)(Index)
