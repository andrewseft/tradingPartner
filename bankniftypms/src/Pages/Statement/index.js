import React, { lazy, useState, useEffect } from "react"
import { Row, Col, Table, Card, Form } from "react-bootstrap"
import { useDispatch, useSelector } from "react-redux"
import { NavLink } from "react-router-dom"
import {
  getStatementData,
  getStatementLinkData,
} from "../../actions/planActions"
import { MuiPickersUtilsProvider, DatePicker } from "@material-ui/pickers"
import DateRangeIcon from "@material-ui/icons/DateRange"
import HighlightOffIcon from "@material-ui/icons/HighlightOff"
import DateFnsUtils from "@date-io/date-fns"
import TextField from "@material-ui/core/TextField"
import Button from "@material-ui/core/Button"
import moment from "moment"
import { useForm } from "react-hook-form"
import SearchIcon from "@material-ui/icons/Search"
import RefreshIcon from "@material-ui/icons/Refresh"
import IconButton from "@material-ui/core/IconButton"
import InputAdornment from "@material-ui/core/InputAdornment"
import GetAppIcon from "@material-ui/icons/GetApp"
import { setToaster } from "../../utils/helpers"
import { useLocation, useHistory } from "react-router-dom"
const queryString = require("query-string")
const Breadcrumb = lazy(() => import("../../Component/Breadcrumb"))

const Index = (props) => {
  const dispatch = useDispatch()
  const location = useLocation()
  const history = useHistory()
  const [fromDate, handleFromDateChange] = useState(null)
  const [toDate, handleToDateChange] = useState(null)
  const { statement } = useSelector((state) => ({
    statement: state.statement,
  }))
  useEffect(() => {
    const fetchData = () => {
      const params = new URLSearchParams(location.search)
      const queryStringParsed = queryString.parse(location.search)
      const request = {}
      if (params.get("start_date")) {
        var from = queryStringParsed["start_date"]
        request.start_date = from
      }
      if (params.get("end_date")) {
        var to = queryStringParsed["end_date"]
        request.end_date = to
      }
      dispatch(getStatementData(request))
    }
    fetchData()
  }, [dispatch, location])

  const renderInputFromDate = (props) => (
    <TextField
      type="text"
      onFocus={props.onClick}
      value={props.value}
      className="w-100"
      id="outlined-formDate"
      label="From"
      variant="outlined"
      size={"small"}
      InputProps={{
        endAdornment: (
          <InputAdornment>
            {fromDate && (
              <IconButton onClick={() => handleFromDateChange(null)}>
                <HighlightOffIcon />
              </IconButton>
            )}
            <IconButton onClick={props.onClick}>
              <DateRangeIcon />
            </IconButton>
          </InputAdornment>
        ),
      }}
    />
  )

  const renderInputToDate = (props) => (
    <TextField
      type="text"
      onFocus={props.onClick}
      value={props.value}
      onChange={props.onChange}
      className="w-100"
      id="outlined-Todate"
      label="To"
      variant="outlined"
      size={"small"}
      InputProps={{
        endAdornment: (
          <InputAdornment>
            {toDate && (
              <IconButton onClick={() => handleToDateChange(null)}>
                <HighlightOffIcon />
              </IconButton>
            )}
            <IconButton onClick={props.onClick}>
              <DateRangeIcon />
            </IconButton>
          </InputAdornment>
        ),
      }}
    />
  )

  const handleClickDate = (date, type) => {
    if (type === "from") {
      handleFromDateChange(date)
    } else if (type === "to") {
      handleToDateChange(date)
    }
  }

  const { handleSubmit } = useForm()
  const onSubmit = () => {
    const requestData = new URLSearchParams(location.search)
    const params = {}
    if (fromDate) {
      requestData.set("start_date", fromDate)
      params.start_date = fromDate
    }
    if (toDate) {
      requestData.set("end_date", toDate)
      params.end_date = toDate
    }
    var size = Object.keys(params).length
    if (size === 0) {
      setToaster("Please select any search criteria to search the records.")
    } else {
      history.push({
        pathname: "/user/statement",
        search: "?" + requestData,
      })
    }
  }
  const handleClickFilter = () => {
    handleFromDateChange(null)
    handleToDateChange(null)
    history.push(`/user/statement`)
  }

  const handleClickDownload = () => {
    const requestData = new URLSearchParams(location.search)
    if (fromDate) {
      requestData.set("start_date", fromDate)
    }
    if (toDate) {
      requestData.set("end_date", toDate)
    }
    dispatch(getStatementLinkData(requestData))
  }

  useEffect(() => {
    const params = new URLSearchParams(location.search)
    const queryStringParsed = queryString.parse(location.search)
    if (params.get("from")) {
      var from = queryStringParsed["from"]
      handleFromDateChange(from)
    }
    if (params.get("to")) {
      var to = queryStringParsed["to"]
      handleToDateChange(to)
    }
  }, [location])

  return (
    <>
      <Breadcrumb {...props} />
      <section className="dashboard_content_main dashbaord_home_dashboard">
        <Row className="m-0 p-0">
          <Col lg={12} className="">
            <Card>
              <Card.Header>
                <Card.Title>Statement</Card.Title>
              </Card.Header>
              <Card.Body>
                <Form onSubmit={handleSubmit(onSubmit)}>
                  <Row className="dashboard_row_change">
                    <Col md={3} className="mb-2">
                      <MuiPickersUtilsProvider utils={DateFnsUtils}>
                        <DatePicker
                          autoOk
                          clearable
                          disableFuture
                          format="yyyy-MM-dd"
                          id="date-picker-inline"
                          className="w-100"
                          label="From (Registered At)"
                          value={fromDate}
                          size={"small"}
                          onChange={(date) =>
                            handleClickDate(
                              date
                                ? moment(new Date(date)).format("YYYY-MM-DD")
                                : null,
                              "from"
                            )
                          }
                          TextFieldComponent={renderInputFromDate}
                        />
                      </MuiPickersUtilsProvider>
                    </Col>
                    <Col md={3} className="mb-2">
                      <MuiPickersUtilsProvider utils={DateFnsUtils}>
                        <DatePicker
                          autoOk
                          clearable
                          disableFuture
                          format="yyyy-MM-dd"
                          id="date-picker-inline"
                          className="w-100"
                          label="To (Registered At)"
                          value={toDate}
                          size={"small"}
                          onChange={(date) =>
                            handleClickDate(
                              date
                                ? moment(new Date(date)).format("YYYY-MM-DD")
                                : null,
                              "to"
                            )
                          }
                          TextFieldComponent={renderInputToDate}
                        />
                      </MuiPickersUtilsProvider>
                    </Col>
                    <Col md={6} className="mb-2">
                      <Button
                        variant="contained"
                        color="default"
                        className="mr-3"
                        type="submit"
                        startIcon={<SearchIcon />}
                      >
                        Search
                      </Button>

                      <Button
                        variant="contained"
                        color="secondary"
                        className="mr-3"
                        startIcon={<RefreshIcon />}
                        onClick={() => handleClickFilter()}
                      >
                        Reset
                      </Button>
                      <Button
                        variant="contained"
                        color="primary"
                        startIcon={<GetAppIcon />}
                        onClick={handleClickDownload}
                      >
                        Excel
                      </Button>
                    </Col>
                  </Row>
                </Form>
              </Card.Body>
            </Card>
          </Col>

          <Col lg={12} className="mt-md-4">
            {statement.length > 0 ? (
              <Table striped bordered hover>
                <thead>
                  <tr>
                    <th scope="col" className="inst">
                      Date
                    </th>
                    <th scope="col">Invested</th>
                    <th scope="col">P&L</th>
                    <th scope="col">%Chg</th>
                  </tr>
                </thead>
                <tbody>
                  {statement.map((item, key) => (
                    <tr key={key}>
                      <td>{item.date}</td>
                      <td>{item.capital}</td>
                      <td
                        className={item.color ? "text-success" : "text-danger"}
                      >
                        {item.pl}
                      </td>
                      <td
                        className={item.color ? "text-success" : "text-danger"}
                      >
                        {item.chg}
                      </td>
                    </tr>
                  ))}
                </tbody>
              </Table>
            ) : (
              <div className="text-center pt-5">
                <img
                  src="../assets/img/orderbook.svg"
                  key={1}
                  alt="no_image"
                  width="150"
                />
                <div className="pt-3">You haven't placed any orders</div>
                <div className="py-3 login-btn">
                  <NavLink
                    to="/user/dashboard"
                    title="Shop Now"
                    exact
                    className="btn py-1"
                  >
                    Dashboard
                  </NavLink>
                </div>
              </div>
            )}
          </Col>
        </Row>
      </section>
    </>
  )
}

export default Index
