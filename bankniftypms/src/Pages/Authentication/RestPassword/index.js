import React, { useState, lazy } from "react"
import { Container, Row, Col, Form } from "react-bootstrap"
import { useForm } from "react-hook-form"
import { useSelector, useDispatch } from "react-redux"
import { resetPassword, resendOtpPassword } from "../../../actions/userActions"
import TextField from "@material-ui/core/TextField"
import IconButton from "@material-ui/core/IconButton"
import InputAdornment from "@material-ui/core/InputAdornment"
import Visibility from "@material-ui/icons/Visibility"
import VisibilityOff from "@material-ui/icons/VisibilityOff"
import { useHistory } from "react-router-dom"
import { NavLink, Link } from "react-router-dom"
const Button = lazy(() => import("../../../Component/Button"))
const Breadcrumb = lazy(() => import("../../../Component/Breadcrumb"))

const Index = (props) => {
  const dispatch = useDispatch()
  const { push } = useHistory()
  const { userParams } = useSelector((state) => ({
    userParams: state.userParams,
  }))
  const { register, errors, handleSubmit } = useForm({
    defaultValues: userParams,
  })

  const onSubmit = (data) => {
    let params = data
    params.email = userParams.email
    dispatch(resetPassword(data, push))
  }
  const [values, setValues] = useState({
    password: false,
  })
  const handleClickShowPassword = () => {
    setValues({ ...values, password: !values.password })
  }

  const resendOtpClick = (e) => {
    e.preventDefault()
    const data = {}
    data.email = userParams.email
    dispatch(resendOtpPassword(data))
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
                      id="outlined-otp"
                      label="OTP*"
                      className="w-100"
                      error={errors.otp ? true : false}
                      name="otp"
                      inputRef={register({
                        required: "Please enter your otp",
                        pattern: {
                          value: /^[0-9\b]+$/i,
                          message: "Otp should only numeric value ",
                        },
                        minLength: {
                          value: 4,
                          message: "Otp should contain atleast 4 characters.",
                        },
                        maxLength: {
                          value: 4,
                          message: "Otp should not exceed 4 characters.",
                        },
                      })}
                      autoFocus={true}
                      helperText={errors.otp && errors.otp.message}
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
                    <div className="checkbox_login d-flex align-items-center"></div>
                    <div>
                      <NavLink exact to="#!" onClick={(e) => resendOtpClick(e)}>
                        Resent OTP
                      </NavLink>
                    </div>
                  </div>
                  <div className="login_btn">
                    <Button
                      title={"Submit"}
                      className={"btn btn-primary shadow-2  mt-3  w-100"}
                    />
                    <p className="mt-5">
                      <NavLink exact to="/login">
                        Back To Login
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
