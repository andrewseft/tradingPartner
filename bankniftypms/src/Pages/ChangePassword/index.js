import React, { lazy, useState } from "react"
import { Row, Col, Form } from "react-bootstrap"
import { useDispatch } from "react-redux"
import { updatePasswordData } from "../../actions/userActions"
import { useForm } from "react-hook-form"
import TextField from "@material-ui/core/TextField"
import IconButton from "@material-ui/core/IconButton"
import InputAdornment from "@material-ui/core/InputAdornment"
import Visibility from "@material-ui/icons/Visibility"
import VisibilityOff from "@material-ui/icons/VisibilityOff"

const Breadcrumb = lazy(() => import("../../Component/Breadcrumb"))
const Button = lazy(() => import("../../Component/Button"))

const Index = (props) => {
  const dispatch = useDispatch()
  const { register, errors, handleSubmit } = useForm()
  const [values, setValues] = useState({
    current_password: false,
    password: false,
    password_confirmation: false,
  })

  const handleClickShowPassword = () => {
    setValues({ ...values, current_password: !values.current_password })
  }

  const handleClickShowPasswordNew = () => {
    setValues({ ...values, password: !values.password })
  }

  const handleClickShowPasswordCon = () => {
    setValues({
      ...values,
      password_confirmation: !values.password_confirmation,
    })
  }
  const onSubmit = (data) => {
    dispatch(updatePasswordData(data))
  }

  return (
    <>
      <Breadcrumb {...props} />
      <section className="dashboard_content_main dashbaord_home_dashboard">
        <Form onSubmit={handleSubmit(onSubmit)}>
          <Row className="m-0 p-0">
            <Col lg={12} className="mb-md-4">
              <div className="heading_title">
                <h1>
                  <span className="nickname">Change Password</span>
                </h1>
              </div>
              <hr></hr>
            </Col>

            <Col lg={6} md={6} sm={6} xs={12}>
              <Form.Group controlId="formBasicCurrentPassword">
                <TextField
                  id="outlined-current_password"
                  label="Current Password*"
                  type={values.current_password ? "text" : "password"}
                  variant="outlined"
                  className="w-100"
                  error={errors.current_password ? true : false}
                  name="current_password"
                  inputRef={register({
                    required: "Please enter your current password",
                    minLength: {
                      value: 6,
                      message:
                        "Current Password should contain atleast 6 characters.",
                    },
                    maxLength: {
                      value: 50,
                      message:
                        "Current password should not exceed 50 characters.",
                    },
                    pattern: {
                      value: /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!()@$%^&*-]).{6,}$/i,
                      message:
                        "Password should contain at-least 1 Uppercase,1 Lowercase, 1 Numeric and 1 special character",
                    },
                  })}
                  helperText={
                    errors.current_password && errors.current_password.message
                  }
                  autoFocus={true}
                  InputProps={{
                    endAdornment: (
                      <InputAdornment>
                        <IconButton onClick={handleClickShowPassword}>
                          {values.current_password ? (
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
              <Form.Group controlId="formBasicPassword">
                <TextField
                  id="outlined-password"
                  label="Password*"
                  type={values.password ? "text" : "password"}
                  variant="outlined"
                  className="w-100"
                  error={errors.password ? true : false}
                  name="password"
                  inputRef={register({
                    required: "Please enter your password",
                    minLength: {
                      value: 6,
                      message: "Password should contain atleast 6 characters.",
                    },
                    maxLength: {
                      value: 50,
                      message: "Password should not exceed 50 characters.",
                    },
                    pattern: {
                      value: /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!()@$%^&*-]).{6,}$/i,
                      message:
                        "Password should contain at-least 1 Uppercase,1 Lowercase, 1 Numeric and 1 special character",
                    },
                  })}
                  helperText={errors.password && errors.password.message}
                  InputProps={{
                    endAdornment: (
                      <InputAdornment>
                        <IconButton onClick={handleClickShowPasswordNew}>
                          {values.password ? <Visibility /> : <VisibilityOff />}
                        </IconButton>
                      </InputAdornment>
                    ),
                  }}
                />
              </Form.Group>
              <Form.Group controlId="formBasicConfirmation">
                <TextField
                  id="outlined-password_confirmation"
                  label="Confirm Password*"
                  type={values.password_confirmation ? "text" : "password"}
                  variant="outlined"
                  className="w-100"
                  error={errors.password_confirmation ? true : false}
                  name="password_confirmation"
                  inputRef={register({
                    required: "Please enter your confirm password",
                    minLength: {
                      value: 6,
                      message:
                        "Confirm password should contain atleast 6 characters.",
                    },
                    maxLength: {
                      value: 50,
                      message:
                        "confirm password should not exceed 50 characters.",
                    },
                    pattern: {
                      value: /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!()@$%^&*-]).{6,}$/i,
                      message:
                        "Confirm password should contain at-least 1 Uppercase,1 Lowercase, 1 Numeric and 1 special character",
                    },
                  })}
                  helperText={
                    errors.password_confirmation &&
                    errors.password_confirmation.message
                  }
                  InputProps={{
                    endAdornment: (
                      <InputAdornment>
                        <IconButton onClick={handleClickShowPasswordCon}>
                          {values.password_confirmation ? (
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
            </Col>
            <Col lg={6} md={6} sm={6} xs={12}></Col>
            <Col lg={3} md={3} sm={3} xs={12}>
              <Button
                title={"Update"}
                className={"btn btn-primary shadow-2  mt-3  w-100"}
              />
            </Col>
          </Row>
        </Form>
      </section>
    </>
  )
}

export default Index
