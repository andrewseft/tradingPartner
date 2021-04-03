import React, { useEffect } from "react"
import { Link, NavLink, useHistory } from "react-router-dom"
import Button from "../../../Component/Button"
import { useForm } from "react-hook-form"
import { connect } from "react-redux"
import { bindActionCreators } from "redux"
import * as userActions from "../../../actions/userActions"
import { Container, Row, Form } from "react-bootstrap"
import TextField from "@material-ui/core/TextField"

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
    let params = data
    params.role_id = 2
    actions.forgotPassword(params, push)
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
                      <h5>FORGOT PASSWORD</h5>
                    </div>

                    <div className="checkout-form pt-0">
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
                        size={"small"}
                      />

                      <Button
                        title={"Submit"}
                        className={"btn btn-primary shadow-2  mt-3  w-100"}
                      />
                      <div className="col-md-12 text-center mt-4">
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
  }
}

function mapDispatchToProps(dispatch) {
  return {
    actions: bindActionCreators(Object.assign(userActions), dispatch),
  }
}

export default connect(mapStateToProps, mapDispatchToProps)(Index)
