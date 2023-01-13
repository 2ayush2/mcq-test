import { Box, Button, Typography } from "@mui/material";
import Loader from "components/Loader";
import { pages } from "links";
import { useEffect, useState } from "react";
import { useHistory, useParams } from "react-router-dom";

export default function Welcome() {
    const [questionList, setList] = useState({ status: 0 });
    const { code } = useParams();
    const history = useHistory();
    useEffect(() => {
        getData();
    }, []);
    const getData = async () => {
        return fetch(`${pages.BASE_URL}api/student/test/${code}`, {
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
            },
        })
            .then(function (response) {
                return response.json();
            })
            .then((e) => {
                if (e.status) {
                    setList((p) => {
                        return {
                            status: 1,
                            ...e.data,
                        };
                    });
                    localStorage.setItem(
                        "questionList",
                        JSON.stringify(e.data)
                    );
                } else {
                    setList({ status: 2 });
                }
            });
    };

    if (questionList.status == 0) {
        return (
            <Typography sx={{ textAlign: "center", m: "10%" }}>
                Loading ...
            </Typography>
        );
    }
    if (questionList.status == 2) {
        return (
            <Box
                sx={{
                    textAlign: "center",
                    m: "5%",
                }}
            >
                <Typography variant="h1" sx={{ color: "red" }}>
                    404 Not Found
                </Typography>
                <Typography>
                    The link you are trying to open has been already user or
                    does not exists
                </Typography>
            </Box>
        );
    }
    console.log(questionList);
    return (
        <>
            <Box
                sx={{
                    textAlign: "center",
                }}
            >
                <Typography variant="h2">
                    Welcome, {questionList.student}
                </Typography>
                <Typography variant="h4">
                    Test : {questionList.title}
                </Typography>
            </Box>
            <Typography>
                Please read following before starting the test:
                <ul>
                    <li>
                        As you have opened the link, you must complete the test.
                    </li>
                    <li>Link would not be valid again</li>
                    <li>You must attempt all the multiple choice questions</li>
                    <li>Do not try to cheat</li>
                </ul>
            </Typography>
            <Box
                sx={{
                    textAlign: "center",
                }}
            >
                <Typography>
                    Ready to go? click below button to start
                </Typography>
                <Button
                    variant="outlined"
                    color="success"
                    onClick={() =>
                        history.push({
                            pathname: pages.QUESTIONS,
                            state: code,
                        })
                    }
                >
                    Start
                </Button>
            </Box>
        </>
    );
}
