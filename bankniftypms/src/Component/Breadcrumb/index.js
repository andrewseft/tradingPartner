import { useEffect } from "react"

const Index = (props) => {
  const { title } = props
  useEffect(() => {
    document.title = title
  }, [title])

  return null
}

export default Index
