import { Button, Typography } from "@mui/material";
import { Box } from "@mui/system";

export default function Result({ student, onSubmit, onBack, submit }) {
    return (
        <Box>
            <Typography variant="h3" sx={{ color: "green" }}>
                Congratulations {student}!!!
            </Typography>
            <br />
            <Typography>
                You have completed the test.
                <br />
                Click on <b>Submit</b> button to submit your answers.
                <br />
                OR click on <b>Back</b> button to go back to your test.
            </Typography>
            {submit ? (
                <Typography>Thank you!!!</Typography>
            ) : (
                <Box my={2}>
                    <Button
                        color="success"
                        variant="contained"
                        onClick={onSubmit}
                    >
                        Submit
                    </Button>
                    <Button
                        sx={{ mx: 4 }}
                        color="warning"
                        variant="contained"
                        onClick={onBack}
                    >
                        Back
                    </Button>
                </Box>
            )}
        </Box>
    );
}
