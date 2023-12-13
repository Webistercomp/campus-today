import UpdatePasswordForm from "./Partials/UpdatePasswordForm";

export default function Settings({ setAlertData }) {
    return (
        <>
            <UpdatePasswordForm setAlertData={setAlertData} />
        </>
    );
}
