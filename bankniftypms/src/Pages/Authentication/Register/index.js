import React, { useState, lazy, useEffect } from "react"
import { Container, Row, Col, Form } from "react-bootstrap"
import { useForm } from "react-hook-form"
import { useDispatch, useSelector } from "react-redux"
import { userRegisterData } from "../../../actions/userActions"
import { loadInvestmentCapital } from "../../../actions/homePageActions"
import TextField from "@material-ui/core/TextField"
import IconButton from "@material-ui/core/IconButton"
import InputAdornment from "@material-ui/core/InputAdornment"
import Visibility from "@material-ui/icons/Visibility"
import VisibilityOff from "@material-ui/icons/VisibilityOff"
import Checkbox from "@material-ui/core/Checkbox"
import FormControlLabel from "@material-ui/core/FormControlLabel"
import { NavLink } from "react-router-dom"
import { useHistory } from "react-router-dom"
import InputLabel from "@material-ui/core/InputLabel"
import MenuItem from "@material-ui/core/MenuItem"
import FormControl from "@material-ui/core/FormControl"
import Select from "@material-ui/core/Select"
const Button = lazy(() => import("../../../Component/Button"))
const Breadcrumb = lazy(() => import("../../../Component/Breadcrumb"))

const Index = (props) => {
  const dispatch = useDispatch()
  const { push } = useHistory()
  const { investmentCapital } = useSelector((state) => ({
    investmentCapital: state.investmentCapital,
  }))
  const { register, errors, handleSubmit } = useForm()
  const onSubmit = (data) => {
    let params = data
    params.investmentCapital = capital
    params.device_token = "web"
    dispatch(userRegisterData(params, push))
  }
  const [values, setValues] = useState({
    password: false,
  })
  const handleClickShowPassword = () => {
    setValues({ ...values, password: !values.password })
  }
  const [capital, setInvestmentCapital] = useState(1)
  const handleChange = (event) => {
    setInvestmentCapital(event.target.value)
  }

  useEffect(() => {
    const fetchData = () => {
      dispatch(loadInvestmentCapital())
    }
    fetchData()
  }, [dispatch])

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
                  <div className="pt-3"></div>
                  <Form.Group controlId="formBasicName">
                    <TextField
                      variant="outlined"
                      id="outlined-name"
                      label="Name*"
                      className="w-100"
                      error={errors.name ? true : false}
                      name="name"
                      inputRef={register({
                        required: "Please enter your name",
                        pattern: {
                          value: /[^\s]+$/i,
                          message: "Accept only alpha characters",
                        },
                        maxLength: {
                          value: 50,
                          message: "Name should not exceed 50 characters.",
                        },
                      })}
                      helperText={errors.name && errors.name.message}
                      autoFocus={true}
                    />
                  </Form.Group>
                  <Form.Group controlId="formBasicEmail">
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
                    />
                  </Form.Group>
                  <Form.Group controlId="formBasicNumber">
                    <TextField
                      variant="outlined"
                      id="outlined-number"
                      label="Number*"
                      className="w-100"
                      error={errors.number ? true : false}
                      name="number"
                      inputRef={register({
                        required: "Please enter your number",
                        pattern: {
                          value: /^[0-9\b]+$/i,
                          message:
                            "Mobile number format is incorrect using like(+911234567890)",
                        },
                        minLength: {
                          value: 10,
                          message:
                            "Number should contain atleast 10 characters.",
                        },
                        maxLength: {
                          value: 10,
                          message: "Nmumber should not exceed 10 characters.",
                        },
                      })}
                      helperText={errors.number && errors.number.message}
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
                  <Form.Group controlId="formBasicReferralCode">
                    <TextField
                      variant="outlined"
                      id="outlined-referral_code"
                      label="Referral Code"
                      className="w-100"
                      error={errors.referral_code ? true : false}
                      name="referral_code"
                      inputRef={register({})}
                      helperText={
                        errors.referral_code && errors.referral_code.message
                      }
                    />
                  </Form.Group>
                  <Form.Group controlId="formBasicReferralCode">
                    <FormControl variant="outlined" className="w-100">
                      <InputLabel id="demo-simple-select-outlined-label">
                        Invest Capital
                      </InputLabel>
                      <Select
                        labelId="demo-simple-select-outlined-label"
                        id="demo-simple-select-outlined"
                        value={investmentCapital.length > 0 ? capital : ""}
                        onChange={handleChange}
                        label="Invest Capital"
                        inputProps={{
                          name: "investmentCapital",
                          id: "outlined-age-native-simple",
                        }}
                      >
                        {investmentCapital.map((item, key) => (
                          <MenuItem value={item.id} key={key}>
                            {item.name}
                          </MenuItem>
                        ))}
                      </Select>
                    </FormControl>
                  </Form.Group>
                  <div className="d-flex justify-content-between">
                    <div className="checkbox_login d-flex align-items-center">
                      <FormControlLabel
                        control={
                          <Checkbox
                            name="remember_me"
                            inputRef={register({
                              required:
                                "Please accept over terms & data policies",
                            })}
                          />
                        }
                        label="By signing up, you agree to our terms & data policies"
                      />
                    </div>
                  </div>
                  <small className="MuiFormHelperText-root Mui-error">
                    {errors.remember_me && errors.remember_me.message}
                  </small>
                  <div className="login_btn">
                    <Button
                      title={"submit"}
                      className={"btn btn-primary shadow-2  mt-3  w-100"}
                    />
                    <p className="mt-5">
                      Already have an account?
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
