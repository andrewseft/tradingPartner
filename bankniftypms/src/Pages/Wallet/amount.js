import React, { lazy } from "react"
import { Row, Col, Modal, Form } from "react-bootstrap"
import { useDispatch, useSelector } from "react-redux"
import { useForm } from "react-hook-form"
import TextField from "@material-ui/core/TextField"
import { addAmountWallet } from "../../actions/walletActions"
const Button = lazy(() => import("../../Component/Button"))
const { REACT_APP_PAYMENT_APP_KEY } = process.env
const Amount = (props) => {
  const dispatch = useDispatch()
  const { walletAmount, userInfo } = useSelector((state) => ({
    walletAmount: state.walletAmount,
    userInfo: state.userInfo,
  }))
  const { register, errors, handleSubmit } = useForm()
  const onSubmit = (data) => {
    let options = {
      key: REACT_APP_PAYMENT_APP_KEY,
      amount: data.amount * 100, // 2000 paise = INR 20, amount in paisa
      name: "BankniftyPMS",
      description: "Add Anmount on wallet",
      image: "https://bankniftypms.com/admin/img/logo.png",
      handler: function (response) {
        props.onHide()
        const params = {}
        params.transaction_id = response.razorpay_payment_id
        params.amount = data.amount
        dispatch(addAmountWallet(params))
      },
      prefill: {
        name: userInfo.name,
        email: userInfo.email,
        contact: "+91" + userInfo.number,
      },
      notify: {
        sms: true,
        email: true,
      },
      theme: {
        color: "#49BE00",
      },
    }
    const rzp = new window.Razorpay(options)
    rzp.open()
  }

  return (
    <>
      <Modal
        {...props}
        size="lg"
        aria-labelledby="contained-modal-title-vcenter"
        centered
      >
        <Modal.Header closeButton>
          <Modal.Title id="contained-modal-title-vcenter">
            Add Amount
          </Modal.Title>
        </Modal.Header>
        <Modal.Body>
          <div className="pl-3">Current Amount : {walletAmount}</div>
          <Form onSubmit={handleSubmit(onSubmit)} className="pt-2">
            <Row className="m-0 p-0">
              <Col lg={6} md={6} sm={6} xs={12}>
                <Form.Group controlId="formBasicNumber">
                  <TextField
                    variant="outlined"
                    id="outlined-number"
                    label="Amount*"
                    className="w-100"
                    error={errors.amount ? true : false}
                    name="amount"
                    inputRef={register({
                      required: "Please enter your amount",
                      pattern: {
                        value: /^[0-9\b]+$/i,
                        message: "amount number format is incorrect.",
                      },
                    })}
                    helperText={errors.amount && errors.amount.message}
                  />
                </Form.Group>
              </Col>
              <Col lg={3} md={3} sm={6} xs={12}>
                <Button
                  title={"Add"}
                  className={"btn btn-primary shadow-2  mt-0  w-100"}
                />
              </Col>
            </Row>
          </Form>
        </Modal.Body>
      </Modal>
    </>
  )
}

export default Amount
