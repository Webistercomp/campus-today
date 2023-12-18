export default function FAQCard({ question, answer }) {
    return (
        <div className="collapse collapse-arrow border-2 bg-white">
            <input type="checkbox" name="my-accordion-2" className="peer" />
            <div className="collapse-title text-xl font-medium peer-checked:bg-curious-blue peer-checked:text-white">
                {question}
            </div>
            <div className="collapse-content peer-checked:bg-curious-blue peer-checked:text-white transition-all duration-150">
                <p>{answer}</p>
            </div>
        </div>
    );
}
