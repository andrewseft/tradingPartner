import React, { lazy } from "react"
import { Row, Col, Modal, Form } from "react-bootstrap"
import { useDispatch, useSelector } from "react-redux"
import { useForm } from "react-hook-form"
import TextField from "@material-ui/core/TextField"
import { requestForWithdrawal } from "../../actions/walletActions"
const Button = lazy(() => import("../../Component/Button"))
const Amount = (props) => {
  const dispatch = useDispatch()
  const { walletAmount } = useSelector((state) => ({
    walletAmount: state.walletAmount,
  }))
  const { register, errors, handleSubmit } = useForm()
  const onSubmit = (data) => {
    props.onHide()
    dispatch(requestForWithdrawal(data))
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
            Withdrawal Amount
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
                  title={"Submit"}
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
