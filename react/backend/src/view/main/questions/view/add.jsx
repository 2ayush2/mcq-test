// Soft UI Dashboard React example components
import { useForm } from 'react-hook-form';
import { useSnackbar } from 'notistack';
import { yupResolver } from '@hookform/resolvers/yup';
import * as yup from 'yup';
import AddForm from './_form';
import { useHistory } from 'react-router-dom';
import { questionsPages } from 'links/pages';
// Custom styles for the Tables

// Service
import { createQuestion } from '../service';
import { Box } from '@mui/system';
import {
  Button,
  Card,
  CardContent,
  CardHeader,
  Typography
} from '@mui/material';

const schema = yup.object({
  title: yup.string().required().max(100).label('Title'),
  expiry_date: yup.string().required().label('Expiry Date')
});

function AddNew() {
  const {
    formState: { errors },
    ...restForm
  } = useForm({
    resolver: yupResolver(schema)
  });
  const { enqueueSnackbar } = useSnackbar();
  const history = useHistory();
  async function onSubmitHandler(fdata) {
    console.log(fdata);
    await createQuestion(fdata).then(({ flag, data }) => {
      if (flag) {
        enqueueSnackbar('Question add success', {
          variant: 'success'
        });
        history.push(questionsPages.QUESTIONS);
      }
    });
  }
  const handleBack = () => {
    history.push(questionsPages.QUESTIONS);
  };
  return (
    <Box px={40} py={5}>
      <Card>
        <CardContent>
          <Box
            display="flex"
            justifyContent="space-between"
            alignItems="center"
          >
            <Typography variant="h3">{'Create new questionaries'}</Typography>
            <Button variant="contained" color="secondary" onClick={handleBack}>
              Back
            </Button>
          </Box>
          <Box py={2}>
            <AddForm
              {...restForm}
              onSubmitHandler={onSubmitHandler}
              errors={errors}
            />
          </Box>
        </CardContent>
      </Card>
    </Box>
  );
}

export default AddNew;
