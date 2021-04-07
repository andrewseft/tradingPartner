import React, { lazy, useEffect, useState } from "react"
import { Row, Col, Form } from "react-bootstrap"
import { useSelector, useDispatch } from "react-redux"
import { userUpdateProfile, getUserProfile } from "../../actions/userActions"
import { loadInvestmentCapital } from "../../actions/homePageActions"
import { useForm } from "react-hook-form"
import TextField from "@material-ui/core/TextField"
import InputLabel from "@material-ui/core/InputLabel"
import MenuItem from "@material-ui/core/MenuItem"
import FormControl from "@material-ui/core/FormControl"
import Select from "@material-ui/core/Select"
import Dropzone from "react-dropzone"
const Breadcrumb = lazy(() => import("../../Component/Breadcrumb"))
const Button = lazy(() => import("../../Component/Button"))

const Index = (props) => {
  const dispatch = useDispatch()
  const { userInfo, investmentCapital } = useSelector((state) => ({
    userInfo: state.userInfo,
    investmentCapital: state.investmentCapital,
  }))
  const { register, errors, handleSubmit } = useForm({
    defaultValues: userInfo,
  })
  const [capital, setInvestmentCapital] = useState(userInfo.investmentCapital)
  const [selectedFile, setSelectedFile] = useState(null)
  const [imageView, setSelectedImage] = useState(userInfo.adahr_card_image)

  const [selectedPanFile, setSelectedPanFile] = useState(null)
  const [imagePanView, setSelectedPanImage] = useState(userInfo.pan_cart_image)

  const handleChange = (event) => {
    setInvestmentCapital(event.target.value)
  }
  useEffect(() => {
    const fetchData = () => {
      dispatch(loadInvestmentCapital())
      dispatch(getUserProfile())
    }
    fetchData()
  }, [dispatch])
  const onSubmit = (data) => {
    const formData = new FormData()
    formData.append("account_number", data.account_number)
    formData.append("adahr_card_number", data.adahr_card_number)
    formData.append("bank_name", data.bank_name)
    formData.append("email", data.email)
    formData.append("ifsc_code", data.ifsc_code)
    formData.append("name", data.name)
    formData.append("number", data.number)
    formData.append("pan_cart_number", data.pan_cart_number)
    formData.append("investmentCapital", capital)
    formData.append("is_kyc", userInfo.is_kyc)
    if (selectedFile && userInfo.is_kyc === 0) {
      formData.append("adahr_card_image", selectedFile)
    }
    if (selectedPanFile && userInfo.is_kyc === 0) {
      formData.append("pan_cart_image", selectedPanFile)
    }
    dispatch(userUpdateProfile(formData))
  }

  const handleDrop = (acceptedFiles) => {
    acceptedFiles.map((file) => setSelectedFile(file))
    const image = acceptedFiles[0]
    if (
      image.type === "image/png" ||
      image.type === "image/jpg" ||
      image.type === "image/jpeg"
    ) {
      if (userInfo.is_kyc === 0) {
        setSelectedImage(URL.createObjectURL(image))
      }
    }
  }

  const handlePanDrop = (acceptedFiles) => {
    acceptedFiles.map((file) => setSelectedPanFile(file))
    const image = acceptedFiles[0]
    if (
      image.type === "image/png" ||
      image.type === "image/jpg" ||
      image.type === "image/jpeg"
    ) {
      if (userInfo.is_kyc === 0) {
        setSelectedPanImage(URL.createObjectURL(image))
      }
    }
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
                  <span className="nickname">Update Profile</span>
                </h1>
              </div>
              <hr></hr>
            </Col>

            <Col lg={6} md={6} sm={6} xs={12}>
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
                      message: "Number should contain atleast 10 characters.",
                    },
                    maxLength: {
                      value: 10,
                      message: "Nmumber should not exceed 10 characters.",
                    },
                  })}
                  helperText={errors.number && errors.number.message}
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
              <Form.Group controlId="formBasicBankName">
                <TextField
                  variant="outlined"
                  id="outlined-name"
                  label="Bank Name*"
                  className="w-100"
                  inputProps={{
                    readOnly: Boolean(userInfo.is_kyc),
                  }}
                  error={errors.bank_name ? true : false}
                  name="bank_name"
                  inputRef={register({
                    required: "Please enter your bank name",
                    pattern: {
                      value: /[^\s]+$/i,
                      message: "Accept only alpha characters",
                    },
                    maxLength: {
                      value: 50,
                      message: "Name should not exceed 50 characters.",
                    },
                  })}
                  helperText={errors.bank_name && errors.bank_name.message}
                  autoFocus={true}
                />
              </Form.Group>
              <Form.Group controlId="formBasicAccountNumber">
                <TextField
                  variant="outlined"
                  id="outlined-name"
                  label="Account Number*"
                  className="w-100"
                  inputProps={{
                    readOnly: Boolean(userInfo.is_kyc),
                  }}
                  error={errors.account_number ? true : false}
                  name="account_number"
                  inputRef={register({
                    required: "Please enter your account number",
                    pattern: {
                      value: /^[0-9\b]+$/i,
                      message: "Accept only alpha characters",
                    },
                    maxLength: {
                      value: 50,
                      message: "Name should not exceed 50 characters.",
                    },
                  })}
                  helperText={
                    errors.account_number && errors.account_number.message
                  }
                  autoFocus={true}
                />
              </Form.Group>
              <Form.Group controlId="formBasicIfscCode">
                <TextField
                  variant="outlined"
                  id="outlined-name"
                  label="IFSC Code*"
                  className="w-100"
                  inputProps={{
                    readOnly: Boolean(userInfo.is_kyc),
                  }}
                  error={errors.ifsc_code ? true : false}
                  name="ifsc_code"
                  inputRef={register({
                    required: "Please enter your banck ifsc code",
                    pattern: {
                      value: /^[0-9a-zA-Z]+$/i,
                      message: "Accept only alpha characters",
                    },
                    maxLength: {
                      value: 50,
                      message: "Name should not exceed 50 characters.",
                    },
                  })}
                  helperText={errors.ifsc_code && errors.ifsc_code.message}
                  autoFocus={true}
                />
              </Form.Group>
            </Col>
            <Col lg={6} md={6} sm={6} xs={12}>
              <Form.Group controlId="formBasicAccountNumber">
                <TextField
                  variant="outlined"
                  id="outlined-name"
                  label="Adhar card numner*"
                  className="w-100"
                  inputProps={{
                    readOnly: Boolean(userInfo.is_kyc),
                  }}
                  error={errors.adahr_card_number ? true : false}
                  name="adahr_card_number"
                  inputRef={register({
                    required: "Please enter your banck ifsc code",
                    pattern: {
                      value: /^[0-9a-zA-Z]+$/i,
                      message: "Accept only alpha characters",
                    },
                    maxLength: {
                      value: 50,
                      message: "Name should not exceed 50 characters.",
                    },
                  })}
                  helperText={
                    errors.adahr_card_number && errors.adahr_card_number.message
                  }
                  autoFocus={true}
                />
              </Form.Group>
              <Form.Group controlId="formBasicPanNumber">
                <TextField
                  variant="outlined"
                  id="outlined-name"
                  label="Pan card numner*"
                  inputProps={{
                    readOnly: Boolean(userInfo.is_kyc),
                  }}
                  className="w-100"
                  error={errors.pan_cart_number ? true : false}
                  name="pan_cart_number"
                  inputRef={register({
                    required: "Please enter your banck ifsc code",
                    pattern: {
                      value: /^[0-9a-zA-Z]+$/i,
                      message: "Accept only alpha characters",
                    },
                    maxLength: {
                      value: 50,
                      message: "Name should not exceed 50 characters.",
                    },
                  })}
                  helperText={
                    errors.pan_cart_number && errors.pan_cart_number.message
                  }
                  autoFocus={true}
                />
              </Form.Group>
              <Dropzone onDrop={handleDrop} accept="image/*" multiple={true}>
                {({ getRootProps, getInputProps }) => (
                  <div {...getRootProps({ className: "dropzone" })}>
                    <input {...getInputProps()} />
                    <p>Upload Adahr Card </p>
                    <small>Click to select file or Drag and Drop</small>
                    <div>
                      {imageView && (
                        <img
                          src={imageView}
                          alt={imageView}
                          width="100px"
                          className="p-2"
                        />
                      )}
                    </div>
                  </div>
                )}
              </Dropzone>
              <Dropzone onDrop={handlePanDrop} accept="image/*" multiple={true}>
                {({ getRootProps, getInputProps }) => (
                  <div {...getRootProps({ className: "dropzone" })}>
                    <input {...getInputProps()} />
                    <p>Upload Pan Card </p>
                    <small>Click to select file or Drag and Drop</small>
                    <div>
                      {imagePanView && (
                        <img
                          src={imagePanView}
                          alt={imagePanView}
                          width="100px"
                          className="p-2"
                        />
                      )}
                    </div>
                  </div>
                )}
              </Dropzone>
            </Col>
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
