import React, { useEffect, useState } from "react"
import { Link, NavLink } from "react-router-dom"
import Button from "../../../Component/Button"
import { useForm } from "react-hook-form"
import { connect } from "react-redux"
import { bindActionCreators } from "redux"
import * as userActions from "../../../actions/userActions"
import { Container, Row, Form } from "react-bootstrap"
import { useHistory } from "react-router-dom"
import TextField from "@material-ui/core/TextField"
import IconButton from "@material-ui/core/IconButton"
import InputAdornment from "@material-ui/core/InputAdornment"
import Visibility from "@material-ui/icons/Visibility"
import VisibilityOff from "@material-ui/icons/VisibilityOff"

const Index = (props) => {
  const { title, superUserParams, actions, link } = props
  const { push } = useHistory()
  const { register, errors, handleSubmit } = useForm({
    defaultValues: superUserParams,
  })
  useEffect(() => {
    document.title = title
    window.scrollTo(0, 0)
  }, [title])

  const onSubmit = (data) => {
    let params = data
    params.role_id = 3
    if (link === null) {
      params.role_id = 2
    }
    if (link != null) {
      params.link = link
    }
    actions.userRegisterData(params, push)
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
                    <div>
                      <Link to="/" className="logo">
                        <img src="assets/images/login-logo.png" alt="logo" />
                      </Link>
                    </div>

                    <div className="">
                      <TextField
                        id="outlined-first_name"
                        label="First Name*"
                        variant="outlined"
                        className="w-100 mb-4"
                        error={errors.first_name ? true : false}
                        name="first_name"
                        inputRef={register({
                          required: "Please enter first name.",
                          minLength: {
                            value: 3,
                            message:
                              "First name should contain atleast 3 characters.",
                          },
                          maxLength: {
                            value: 50,
                            message:
                              "First name should not exceed 50 characters.",
                          },
                        })}
                        helperText={
                          errors.first_name && errors.first_name.message
                        }
                        autoFocus={true}
                        size={"small"}
                      />
                      <TextField
                        id="outlined-last_name"
                        label="Last Name*"
                        variant="outlined"
                        className="w-100 mb-4"
                        error={errors.last_name ? true : false}
                        name="last_name"
                        inputRef={register({
                          required: "Please enter last name.",
                          minLength: {
                            value: 3,
                            message:
                              "Last name should contain atleast 3 characters.",
                          },
                          maxLength: {
                            value: 50,
                            message:
                              "Last name should not exceed 50 characters.",
                          },
                        })}
                        helperText={
                          errors.last_name && errors.last_name.message
                        }
                        size={"small"}
                      />
                      <TextField
                        variant="outlined"
                        id="outlined-email"
                        label="Email Address*"
                        className="w-100 mb-4"
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
                        title={"Sign Up"}
                        className={"btn btn-primary shadow-2  mt-5  w-100"}
                      />

                      <div className="col-md-12 text-center mt-5">
                        <NavLink to="/login" className="dont-have-account">
                          Already have an account ?
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
    link: state.link,
  }
}

function mapDispatchToProps(dispatch) {
  return {
    actions: bindActionCreators(Object.assign(userActions), dispatch),
  }
}

export default connect(mapStateToProps, mapDispatchToProps)(Index)
