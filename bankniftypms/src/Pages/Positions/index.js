import React, { lazy, useEffect, useState } from "react"
import { useDispatch, useSelector } from "react-redux"
import { NavLink } from "react-router-dom"
import { getPositionData } from "../../actions/orderActions"
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
import { Row, Col, Card, Form, Table } from "react-bootstrap"
import { setToaster } from "../../utils/helpers"
import { useLocation, useHistory } from "react-router-dom"
const Breadcrumb = lazy(() => import("../../Component/Breadcrumb"))
const queryString = require("query-string")

const Index = (props) => {
  const dispatch = useDispatch()
  const location = useLocation()
  const history = useHistory()
  const [fromDate, handleFromDateChange] = useState(null)
  const [toDate, handleToDateChange] = useState(null)
  const [keyword, setKeyword] = useState("")
  const [showFilter, setShowFilter] = useState(false)
  const { holding, holdingList } = useSelector((state) => ({
    holding: state.holding,
    holdingList: state.holdingList,
  }))
  useEffect(() => {
    const fetchData = () => {
      const params = new URLSearchParams(location.search)
      const queryStringParsed = queryString.parse(location.search)
      const request = {}
      if (params.get("keyword")) {
        var keyword = queryStringParsed["keyword"]
        request.keyword = keyword
      }
      if (params.get("from")) {
        var from = queryStringParsed["from"]
        request.from = from
      }
      if (params.get("to")) {
        var to = queryStringParsed["to"]
        request.to = to
      }

      dispatch(getPositionData(request))
    }
    fetchData()
  }, [dispatch, location])

  useEffect(() => {
    const params = new URLSearchParams(location.search)
    const queryStringParsed = queryString.parse(location.search)
    if (params.get("keyword")) {
      var keyword = queryStringParsed["keyword"]
      setKeyword(keyword)
      setShowFilter(true)
    }
    if (params.get("from")) {
      var from = queryStringParsed["from"]
      handleFromDateChange(from)
      setShowFilter(true)
    }
    if (params.get("to")) {
      var to = queryStringParsed["to"]
      handleToDateChange(to)
      setShowFilter(true)
    }
  }, [location])

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
    if (keyword) {
      requestData.set("keyword", keyword)
      params.keyword = keyword
    }
    if (fromDate) {
      requestData.set("from", fromDate)
      params.from = fromDate
    }
    if (toDate) {
      requestData.set("to", toDate)
      params.to = toDate
    }
    var size = Object.keys(params).length
    if (size === 0) {
      setToaster("Please select any search criteria to search the records.")
    } else {
      history.push({
        pathname: "/user/positions",
        search: "?" + requestData,
      })
    }
  }

  const handleClickFilter = () => {
    handleFromDateChange(null)
    handleToDateChange(null)
    setKeyword("")
    history.push(`/user/positions`)
  }

  const handleClickFilterShow = () => {
    setShowFilter(!showFilter)
  }

  return (
    <>
      <Breadcrumb {...props} />
      <section className="dashboard_content_main dashbaord_home_dashboard">
        <Row className="m-0 p-0">
          <Col>
            <Card>
              <Card.Header>
                <Card.Title>
                  Positions({holding.length}){" "}
                  <span className="float-right">
                    <Button
                      variant="contained"
                      startIcon={<SearchIcon />}
                      onClick={() => handleClickFilterShow()}
                    >
                      Filter
                    </Button>
                  </span>
                </Card.Title>
              </Card.Header>
              {showFilter && (
                <Card.Body>
                  <Form onSubmit={handleSubmit(onSubmit)}>
                    <Row className="dashboard_row_change">
                      <Col md={4} className="mb-2">
                        <TextField
                          className="w-100"
                          id="outlined-basic"
                          label="Search by plan"
                          variant="outlined"
                          size={"small"}
                          name="keyword"
                          value={keyword}
                          onChange={(event) => setKeyword(event.target.value)}
                        />
                      </Col>
                      <Col md={4} className="mb-2">
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
                      <Col md={4} className="mb-2">
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
                    </Row>

                    <div className="mt-3">
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
                        startIcon={<RefreshIcon />}
                        onClick={() => handleClickFilter()}
                      >
                        Reset
                      </Button>
                    </div>
                  </Form>
                </Card.Body>
              )}
            </Card>
          </Col>

          <Col lg={12} className="mt-md-4">
            {holding.length > 0 ? (
              <Table striped bordered hover>
                <thead>
                  <tr>
                    <th scope="col">Product</th>
                    <th scope="col">Plan</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Avg</th>
                    <th scope="col">P&L</th>
                  </tr>
                </thead>
                <tbody>
                  {holding.map(
                    (item, key) =>
                      item && (
                        <tr key={key}>
                          <td>
                            {item.category &&
                              item.category.map((tag, key) => (
                                <span key={key}>{tag.title}</span>
                              ))}
                          </td>
                          <td>{item.title}</td>
                          <td>{item.qty}</td>
                          <td>{item.currentAmount}</td>
                          <td>{item.totalAmount}</td>
                        </tr>
                      )
                  )}
                </tbody>
              </Table>
            ) : keyword || fromDate || toDate ? (
              <div className="text-center pt-5">
                <img
                  src="../assets/img/orderbook.svg"
                  key={1}
                  alt="no_image"
                  width="150"
                />
                <div className="pt-3">Sorry we have't found any order</div>
              </div>
            ) : (
              <div className="text-center pt-5">
                <img
                  src="../assets/img/orderbook.svg"
                  key={1}
                  alt="no_image"
                  width="150"
                />
                <div className="pt-3">You haven't placed any orders today</div>
                <div className="py-3 login-btn">
                  <NavLink
                    to="/user/dashboard"
                    title="Shop Now"
                    exact
                    className="btn py-1"
                  >
                    Get started
                  </NavLink>
                </div>
              </div>
            )}
          </Col>
          {holding.length > 0 && (
            <Col lg={10} className="mt-md-3">
              <div className="dashbaord_wallet_inner">
                <div className="d-flex justify-content-between mt-2 mt-md-4">
                  <div className="wallet_content_main w-100">
                    <div className="wallet_counter d-flex align-items-baseline">
                      <span
                        className={
                          holdingList.color ? "text-success" : "text-danger"
                        }
                      >
                        {holdingList.totalPl}
                      </span>
                      <p
                        className={
                          holdingList.color
                            ? "text-success ml-2"
                            : "text-danger ml-2"
                        }
                      ></p>
                    </div>

                    <div className="label_wallet">
                      <span>Total Profit Loss</span>
                    </div>
                  </div>
                </div>
              </div>
            </Col>
          )}
        </Row>
      </section>
    </>
  )
}

export default Index
